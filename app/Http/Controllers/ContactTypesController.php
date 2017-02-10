<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ContactType;
use Illuminate\Support\Facades\Session;

class ContactTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_types = ContactType::all();
        return view('contact_types.index')->withcontact_types($contact_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //var_dump($request);
        //validation
        $this->validate($request , array(
            'contact_type_name'=>'required|min:2|max:10|unique:contact_types,contact_type_name',
            'contact_type_code'=>'required|min:2|max:10|unique:contact_types,contact_type_code',
            'contact_type_status'=>'required'
        ));
        $contact_type = new ContactType();

        //define database fields
        $contact_type->contact_type_name = $request->contact_type_name;
        $contact_type->contact_type_code = $request->contact_type_code;
        $contact_type->contact_type_status = $request->contact_type_status;

        //save the data into the database
        $contact_type->save();

        //after saving successfully display a success message
        Session::flash('success','Contact type has been added');


        return redirect()->route('contact_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact_type = ContactType::find($id);
        return withContact_type($contact_type);
//        return view('contact_types.index')->withContact_type($contact_type);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
