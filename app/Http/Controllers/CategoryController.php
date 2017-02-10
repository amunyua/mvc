<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        return view('category.index',array(
            'parent_categories'=>Category::all()
        ));
    }

    public function storeCategory(Request $request){
//        var_dump($_POST);die;
        $this->validate($request, array(
            'category_name'=>'required|unique:categories,category_name',
//            'parent_category'=>'required',
            'code'=>'required',
            'status'=>'required'
        ));

        $category = new Category();

        $category->parent_category = $request->parent_category;
        $category->category_name = $request->category_name;
        $category->code = $request->code;
        $category->status = $request->status;

        $category->save();

        Session::flash('success','The category has been added');

       return redirect('categories');
    }
}
