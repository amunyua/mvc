<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

use App\Http\Requests;

class RoutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        $proutes = Route::whereNull('parent_route')->get();

        return view('system.routes', [
            'proutes' => $proutes
        ]);
    }

    public function loadRoutes(){
        $routes = Route::all();
        return Datatables::of($routes)
            ->editColumn('route_status',
                '@if($route_status)
                    Active 
                @else
                    Inactive
                @endif')
            ->editColumn('parent_route',
                '@if(!empty($parent_route))
                    {{ App\Route::find($parent_route)->route_name }}
                @endif')
            ->make(true);
    }

    public function getRoute(Request $request){
        $route_id = $request->route_id;

        if(!empty($route_id)){
            $route = Route::find($route_id);
            return Response::json($route);
        }
    }

    public function getParentRoutes(){
        $q = $_GET['q'];
        $proutes = Route::whereNull('parent_route')
            ->Where('route_name', 'like', '%'.$q.'%')
            ->get();

        $return = [];
        if(count($proutes)){
            foreach($proutes as $proute){
                $return[] = array(
                    'id' => $proute->id,
                    'text' => $proute->route_name
                );
            }
        }

        $options['items'] = $return;
        return Response::json($options);
    }

    public function store(Request $request){
        // validation
        $validator = Validator::make($request->all(), [
            'route_name' => 'required|unique:routes',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{
            $route = new Route();
            $route->route_name = $request->route_name;
            $route->url = $request->url;
            $route->route_status = $request->status;
            $route->parent_route = (!empty($request->parent)) ? $request->parent : NULL;
            $route->save();

            return Response::json([
                'success' => true
            ]);
        }
    }

    public function update(Request $request){
        // validation
        $validator = Validator::make($request->all(), [
            'route_name' => 'required|unique:routes,route_name,'.$request->edit_id,
            'status' => 'required'
        ]);

        if($validator->fails()){
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{
            try {
                Route::where('id', $request->edit_id)
                    ->update([
                        'route_name' => $request->route_name,
                        'url' => $request->url,
                        'route_status' => $request->status,
                        'parent_route' => (!empty($request->parent)) ? $request->parent : NULL
                    ]);

                return Response::json([
                    'success' => true
                ]);
            } catch (QueryException $qe) {
                return Response::json([
                    'false' => false
                ]);
            }
        }
    }

    public function destroy(Request $request){
        if(Route::destroy($request->id)){
            $return = [
                'success' => true
            ];
        }else{
            $return = [
                'success' => false
            ];
        }
        return Response::json($return);
    }
}
