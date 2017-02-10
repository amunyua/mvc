<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactTypes;
use App\County;
use App\Masterfile;
use App\Role;
use App\Form;
use App\Stream;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use App\Exceptions\Handler;

class MasterfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

//        $streams = Stream::where('stream_status', 1)->get();
        $dependants = Masterfile::where('depends_on', 0)->get();

        return view('registration.index', array(
            'dependants' => $dependants
        ));
    }

    public function storeMasterfile(Request $request){
//        var_dump($_POST);die;
        $rules = array(
            'role' => 'required',
//            'id_no' => 'required|max:8|unique:masterfiles,id_no',
            'firstname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
//            'phone_number'=>'required',
//            'email'=>'required|unique:contacts,email'
//            'regdate' => 'required'
        );
        $this->validate($request, $rules);

        DB::transaction(function(){
//            $role = Role::where('role_code', Input::get('role'))->first();

            // create registration
            if(!empty(Input::get('depends_on'))){
                $depends_on = Input::get('depends_on');
            }else{
                $depends_on = 0;
            }
            if(Input::get('role') != 'Staff'){
                $b_role = Input::get('role');
            }else{
                $b_role = Input::get('business_role');
            }
                $reg = new Masterfile();
                $reg->surname = Input::get('surname');
                $reg->firstname = Input::get('firstname');
                $reg->middlename = Input::get('middlename');
                $reg->id_no = Input::get('id_no');
                $reg->user_role = Input::get('role');
                $reg->b_role = $b_role;
                $reg->depends_on = $depends_on;
                $reg->save();
                $reg_id = $reg->id;

                 // create contact
                $contact = new Contact();
                $contact->city = Input::get('city');
                $contact->postal_address =  Input::get('postal_address');
                $contact->physical_address =  Input::get('physical_address');
                $contact->masterfile_id =  $reg_id;
                $contact->phone_number =  Input::get('phone_number');
                $contact->email =  Input::get('email');
//                $contact->mobile_no =  Input::get('mobile_no');
                $contact->save();
//            if(Input::get('role')== 'owner') {
//                // create user login account
//                $password = bcrypt(123456);
//                $login = new User();
//                $login->masterfile_id = $reg_id;
//                $login->email =Input::get('email');
//                $login->phone_no = Input::get('phone_no');
//                $login->password = $password;
//                $login->user_role = 1;
//                $login->save();
//            }
            Session::flash('success','The masterFile has been created');
        });
        return redirect('all-masterfiles');
    }

    public function client(Request $request){
        $rules = array(
            'role' => 'required',
            'id_no' => 'required',
            'firstname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'regdate' => 'required'
        );
        $this->validate($request, $rules);

        DB::transaction(function(){
            $role = Role::where('role_code', Input::get('role_code'))->first();

            // create registration
            $reg = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'first_name' => Input::get('firstname'),
                'middle_name' => Input::get('middlename'),
                'regdate' => Input::get('regdate'),
                'gender' => Input::get('gender'),
                'id_no' => Input::get('id_no'),
                'b_role' => 'Staff',
                'user_role' => 1
            ));
            $reg->save();
            $reg_id = $reg->id;

            // create contact
            $contact = Contact::create(array(
                'postal_address' => Input::get('postal_address'),
                'physical_address' => Input::get('physical_address'),
                'masterfile_id' => $reg_id,
                'telephone_no' => Input::get('tel_no'),
                'email' => Input::get('email'),
                'mobile_no' => Input::get('mobile_no')
            ));
            $contact->save();

            // create user login account
            $password = sha1(123456);
            $login = User::create(array (
                'masterfile_id' => $reg_id,
                'email' => Input::get('email'),
                'phone_no' => Input::get('phone_no'),
                'password' => $password
            ));
//            var_dump($login);exit;
            $login->save();
        });
    }

    public function getAllMasterfiles(){
        $all_masterfiles = Masterfile::all();
        return view('masterfile.all-masterfiles',array(
            'all_masterfiles'=>$all_masterfiles
        ));
    }

    public function loadMasterFiles(){
        $masterfiles = DB::table('all_masterfiles')->get();
        return Datatables::of($masterfiles)->make(true);
    }

//    public function deleteMasterfile($id){
//        $id = Masterfile::find($id);
//        if($id->delete()) {
//            Session::flash('success' . 'The masterfile has been deleted');
//            return redirect('all-masterfiles');
//        }else{
//            Session::flash('warning','Cannot delete this masterfile for it is being referenced somewhere else');
//        }
//    }

    public function deleteMasterfile($id){
        try {
            Masterfile::destroy($id);
            Session::flash('success','The masterfile has been deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            $message = $this->handleException($e);
            Session::flash('failed', $message);
            return redirect()->back();
        }
    }
}
