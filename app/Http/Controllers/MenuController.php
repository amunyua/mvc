<?php

namespace App\Http\Controllers;

use App\faIcon;
use App\Menu;
use App\Route;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $routes = Route::all();
        $fas = faIcon::whereNotNull('id')->orderBy('icon_name', 'asc')->get();
        $menus = Menu::all();

        return view('system.menu', array(
            'routes' => $routes,
            'menus' => $menus,
            'fas' => $fas
        ));
    }

    public function store(Request $request){
        $this->validate($request, [
            'route' => 'required|numeric',
            'status' => 'required'
        ]);

        $last_sequence = (empty($request->parent_menu)) ? Menu::whereNull('parent_menu')->max('sequence') : Menu::whereNotNull('parent_menu')->where('parent_menu', $request->parent_menu)->max('sequence');
        $sequence = $last_sequence + 1;

        $menu = new Menu();
        $menu->route_id = $request->route;
        $menu->parent_menu = (!empty($request->parent_menu)) ? $request->parent_menu : NULL;
        $menu->menu_status = $request->status;
        $menu->fa_icon = $request->fa_icon;
        $menu->sequence = $sequence;
        $menu->save();

        $request->session()->flash('status', 'The Menu Item has been added');
        return redirect('menu');
    }

    public function getMenu($parent_id){
        $menus = (is_null($parent_id) || empty($parent_id)) ? Menu::whereNull('parent_menu')->orderBy('sequence', 'asc')->get() : Menu::where('parent_menu', $parent_id)->orderBy('sequence', 'asc')->get();

        if(count($menus)){
            echo '<ol class="dd-list">';

            foreach ($menus as $item){
                // show parent menu first
                $route_id = $item->route_id;
                $menu_name = Route::find($route_id)->route_name;

                echo '<li class="dd-item dd3-item" data-id="'.$item->id.'">';
                echo '<div class="dd-handle dd3-handle"> Drag</div>';

                echo '<div class="dd3-content">';
                echo '<i class="fa '.$item->fa_icon.'"></i> '.$menu_name;

                echo '<div class="pull-right">
                        <div class="checkbox no-margin">
                        <label>
                        <input type="checkbox" class="checkbox style-0" value="'.$item->id.'">  
                      <span class="font-xs" menu-id="'.$item->id.'"><a href="#edit-menu" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a></span>
                        </label>
                        </div>
                        </div>';

                echo '</div>';

                $this->getMenu($item->id);
                echo '</li>';
            }

            echo '</ol>';
        }
    }

    public function arrangeMenu(Request $request){
        $menu_data = $request->menu_data;
        $menu_array = json_decode($menu_data);

        $parent_sequence = 1;
        if(count($menu_array)){
            foreach ($menu_array as $array){
                $parent_id = $array->id;

                // update sequence for the parent menu item
                Menu::where('id', $parent_id)
                    ->update([
                        'sequence' => $parent_sequence,
                        'parent_menu' => NULL
                    ]);

                $child_sequence = 1;
                if(isset($array->children)) {
                    $children = $array->children;
                    foreach ($children as $child) {
                        $child_id = $child->id;

                        // update the sequence for the child menu item
                        Menu::where('id', $child_id)
                            ->update([
                                'sequence' => $child_sequence,
                                'parent_menu' => $parent_id
                            ]);

                        $child_sequence++;
                    }
                }

                $parent_sequence++;
            }
        }
        $request->session()->flash('status', 'Menu has been updated');
        return redirect('menu');
    }

    public function update(Request $request){
        $this->validate($request, [
            'route' => 'required|numeric',
            'status' => 'required',
            'edit_id' => 'required|numeric'
        ]);

        Menu::where('id', $request->edit_id)
            ->update([
                'route_id' => $request->route,
                'menu_status' => $request->status,
                'fa_icon' => $request->fa_icon
            ]);

        $request->session()->flash('status', 'The Item has been updated');
        return redirect('menu');
    }

    public function getMenuItem(Request $request){
        $id = $request->id;

        $menu = Menu::find($id);
        return Response::json($menu);
    }

    public function destroy(Request $request){
        $selected = $request->selected;

        if(Menu::destroy($selected)){
            $request->session()->flash('status', 'The Item has been removed');
            return Response::json(['success' => true]);
        }
    }

    public function loadSideMenu($parent_id){
        $menus = (is_null($parent_id) || empty($parent_id)) ? Menu::whereNull('parent_menu')->where([['menu_status', '=', 1]])->orderBy('sequence', 'asc')->get() : Menu::where([['parent_menu', '=', $parent_id], ['menu_status', '=', 1]])->orderBy('sequence', 'asc')->get();

        $route_name = \Route::getFacadeRoot()->current()->uri();

        if(count($menus)) {
            echo '<ul>';

            foreach ($menus as $menu) {
                $route = Route::find($menu->route_id);
                $url = (is_null($parent_id)) ? '#' : $route->url;
                $li_class = (is_null($parent_id)) ? 'top-menu-invisible': '';
                $lip_active = ($route_name == $url) ? 'active open': '';
                $user = Auth::user();

                // get user role
                $roles = DB::table('role_user')->where('user_id', $user->id)->get();
                $the_roles = [];
                if(count($roles)){
                    foreach ($roles as $role){
                        // get user roles
                        $the_roles[] = $role->role_id;
                    }
                }
                $allocated_routes = [];
                $allocated_route_ids = [];
                $the_user_routes = DB::table('role_route')->whereIn('role_id', $the_roles)->get();
//                print_r($the_user_routes);exit;
                if(count($the_user_routes)) {
                    foreach ($the_user_routes as $alloc_route) {
                        $allocated_routes[] = Route::find($alloc_route->route_id)->route_name;
                        $allocated_route_ids[] = $alloc_route->route_id;
                    }
                }

//                print_r($allocated_routes);exit;
                $allocated_parents = $this->getAllocatedParentRoutes($allocated_route_ids);
//                print_r($allocated_parents);exit;
                if(!is_null($parent_id)) {
                    if (in_array($route->route_name, $allocated_routes)) {
                        echo '<li class="' . $li_class . ' ' . $lip_active . '">';

                        echo '<a href="' . url($url) . '" title="' . $route->route_name . '">';
                        echo (!empty($menu->fa_icon)) ? '<i class="fa fa-lg fa-fw ' . $menu->fa_icon . ' txt-color-blue"></i> ' : '';
                        echo '<span class="menu-item-parent">';
                        echo $route->route_name . '</span></a>';

                        $this->loadSideMenu($menu->id);
                        echo '</li>';
                    }
                }else{
                    if(in_array($route->id, $allocated_parents)){
                        echo '<li class="' . $li_class . ' ' . $lip_active . '">';

                        echo '<a href="' . url($url) . '" title="' . $route->route_name . '">';
                        echo (!empty($menu->fa_icon)) ? '<i class="fa fa-lg fa-fw ' . $menu->fa_icon . ' txt-color-blue"></i> ' : '';
                        echo '<span class="menu-item-parent">';
                        echo $route->route_name . '</span></a>';

                        $this->loadSideMenu($menu->id);
                        echo '</li>';
                    }
                }
            }

            echo '</ul>';
        }
    }

    public function getAllocatedParentRoutes($child_routes = []){
        $parent_routes = Route::whereIn('id', $child_routes)->get();
        $p_route_id = [];
        if(count($parent_routes)){
            foreach ($parent_routes as $p_route){
                $p_route_id[] = $p_route->parent_route;
            }
        }
        return $p_route_id;
    }
}
