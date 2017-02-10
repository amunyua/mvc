<?php

namespace App\Http\Controllers;

use App\AuditTrail;
use App\Masterfile;
use App\Role;
use App\User;
use App\UserRole;
use App\SystemConfig;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use SmoDav\Mpesa\Native\Mpesa;
use Yajra\Datatables\Facades\Datatables;
use App\Route;
use Illuminate\Support\Facades\Input;

class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function getAllUsers(){
        $mfs = DB::table('all_users')->get();
        return view('user_manager.all_users', ['mfs' => $mfs]);
    }

    public function getIndex(){
        $mfs = Role::all();
        $routes = Route::whereNotNull('parent_route')->get();
        return view('user_manager.user_roles', [
            'routes' => $routes,
            'mfs' => $mfs
        ]);
    }

    public function storeRole(Request $request){
//        var_dump($_POST);

        $this->validate($request,array(
            'role_name'=>'required|min:3|unique:roles,role_name',
            'role_code'=>'required|min:3|unique:roles,role_code',
            'status'=>'required'
        ));
        try {
            $user_role = new Role();
            $user_role->role_name = $request->role_name;
            $user_role->role_code = strtoupper($request->role_code);
            $user_role->role_status = $request->status;
            $user_role->save();
            Session::flash('success','User Role ('.$request->role_name.') has been added');
        } catch (\Illuminate\Database\QueryException $e) {
             $message =  $this->handleException($e);
//            var_dump($message);
            Session::flash('warning', $message);
//            return redirect()->back()->withInput();
        }
        return redirect('user_roles');
    }

    public function destroyRole($user_id){
        DB::table('role_user')->where('id', $user_id)->delete();
        DB::table('masterfiles')->where('id', $user_id)->delete();

        Session::flash('success','user has been deleted');
        return redirect('all_users');
    }

    public function auditTrails(){
//        $audit_trails = AuditTrail::all();
        return view('user_manager.audit_trails');
    }

    public function ajaxAuditTrails(){
//        $audit_trails = AuditTrail::all();
        return Datatables::of(AuditTrail::all())->make(true);
    }

    public function loadRoutesForAllocation(){
        $routes = Route::whereNotNull('parent_route')->where('route_status', 1);
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
            ->addColumn('attach_detach', function($route){
                return '<input type="checkbox" class="attach custom_checkbox" value="'.$route->id.'" role-id=""/>';
            })
            ->make(true);
    }

    public function attachRoute(Request $request){
//        var_dump($request->route_id);exit;
        $route = Route::find($request->route_id);
        $route->roles()->attach($request->role_id);
        return Response::json([
            'success' => true,
            'message' => 'Route has been allocated!'
        ]);
    }

    public function detachRoute(Request $request){
//        var_dump($request->route_id);exit;
        $route = Route::find($request->route_id);
        $route->roles()->detach($request->role_id);
        return Response::json([
            'success' => true,
            'message' => 'Route has been detached!'
        ]);
    }

    public function getRoleEditDetails($id){
        $role = Role::find($id);
        return Response::json($role);
    }

    public function updateUserRoleDetails(Request $request, $id){
        $this->validate($request, array(
            'role_name'=>'required',
            'role_code'=>'required',
            'status'=>'required'
        ));

        $role = Role::find($id);
        $role->role_name = $request->role_name;
        $role->role_code = $request->role_code;
        $role->role_status = $request->status;

        try{
            $role->save();
            Session::flash('success','The user role has been updated');
        } catch (\Illuminate\Database\QueryException $e){
            $message = $this->handleException($e);
            Session::flash('warning',$message);
        }
        return redirect('user_roles');
    }

    public function isRouteAllocated(Request $request){
        $role = $request->id;

        // get routes allocated to the role
        $routes = DB::table('role_route')->where('role_id', $role)->get();

        return Response::json($routes);
    }

    public function blockUser(Request $request){
        $id = $request->user_id;
        $return = [];

        try {
            // update db record
            User::where('id', $id)
                ->update(['status' => 0]);

            $return = [
                'success' => true,
                'message' => 'User has been BLOCKED!',
                'type' => 'success'
            ];
        } catch (QueryException $qe){
            $return = [
                'success' => false,
                'message' => $qe->getMessage(),
                'type' => 'success'
            ];
        }

        return Response::json($return);
    }

    public function unblockUser(Request $request){
        $id = $request->user_id;
        $return = [];

        try {
            // update db record
            User::where('id', $id)
                ->update(['status' => 1]);

            $return = [
                'success' => true,
                'message' => 'User has been UNBLOCKED!',
                'type' => 'success'
            ];
        } catch (QueryException $qe){
            $return = [
                'success' => false,
                'message' => $qe->getMessage(),
                'type' => 'success'
            ];
        }

        return Response::json($return);
    }

    public function updateSystemConfig(Request $request){

        $this->validate($request, [
            'company_name' => 'required',
            'tel_one' => 'required',
            'tel_two' => 'required',
            'tel_three' => 'required',
            'email' => 'required',
            'physical_address' => 'required',
//            'company_logo' => 'image|dimensions:min_width=246,min_height=52'
        ]);

        // upload image if exists
        $path = '';
        if(Input::hasFile('company_logo')){
            $prefix = uniqid();
            $image = Input::file('company_logo');
            $filename = $image->getClientOriginalName();
            $new_name = $prefix.$filename;

            if($image->isValid()) {
                $image->move('uploads/images', $new_name);
                $path = 'uploads/images/'.$new_name;
            }
        }
        try{
            $current_image = SystemConfig::find(1)->company_logo;
            $system = SystemConfig::where('id', 1)
                ->update(array(
                    'company_name' => $request->company_name,
                    'company_logo' => (!empty($path)) ? $path : $current_image,
                    'tel_one' => $request->tel_one,
                    'tel_two' => $request->tel_two,
                    'tel_three' => $request->tel_three,
                    'email' => $request->email,
                    'email_two' => $request->email_two,
                    'box_office' => $request->box_office,
                    'physical_address' => $request->physical_address,
                    'paybill_no' => $request->paybill_no,
                    'service_pin' => $request->service_pin
                ));

            $request->session()->flash('status', 'System Configurations have been updated');
        } catch(QueryException $qe) {
            $request->session()->flash('error', 'Encountered an error: '.$qe->getMessage());
        }

        return redirect('load-config');
    }

    public function loadSystemConfig(Request $request){
        $id = 1;
        $sys = SystemConfig::find($id);

        return view('system.system_config', array(
            'sys' => $sys
        ));
    }
}
