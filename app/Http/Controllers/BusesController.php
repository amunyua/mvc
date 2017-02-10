<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Masterfile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class BusesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getBuses(){
        $buses = Bus::all();
        $owners = Masterfile::where('user_role','Ma3 owner')->get();
        return view('configurations.buses',array(
            'buses'=>$buses,
            'owners'=>$owners
        ));
    }

    public function storeBus(Request $request){
        $this->validate($request,array(
            'number_plate'=>'required|min:3|unique:buses,number_plate|min:7|max:7',
            'status'=>'required'
        ));
//        $this->logAction('add_user_role');
        $bus = new Bus();
        $bus->number_plate = strtoupper($request->number_plate);
        $bus->owner_id = $request->owner_id;
        $bus->status = $request->status;
        $bus->alias_name = $request->alias_name;


        $bus->save();
        Session::flash('success','Bus ('.strtoupper($request->number_plate).') has been added');
        return redirect('all-buses');
    }

    public function loadBusEditD($id){
        $bus = Bus::find($id);
        return Response::json($bus);
    }

    public function editBus(Request $request, $id){
//        var_dump($_POST);
        $bus = Bus::find($id);
        $bus->number_plate = $request->number_plate;
        $bus->alias_name = $request->alias_name;
        $bus->owner_id = $request->owner_id;
        $bus->status = $request->status;
        $bus->save();
        Session::flash('success','Bus ('.$request->alias_name.') has been edited');
        return redirect('all-buses');
    }

    public function deleteBus(Request $request, $id){
        try {
            Bus::destroy($id);
            Session::flash('success','The bus has been deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('failed','The bus cannot be deleted because it\'s being used somewhere else, try making it inactive');
        }
        return redirect()->back();
    }
}
