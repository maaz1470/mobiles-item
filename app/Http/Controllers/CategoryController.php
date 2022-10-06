<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Cookie;
use Session;
use View;
class CategoryController extends Controller
{

    public function admin_id()
    {
        return Cookie::get('client') ?? Session::get('admin_id');
    }
    public function add(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(),[
                'category_name'         => 'required|String|max:255',
                'status'                => 'required'
            ]);

            if($validator->fails()){
                return Response()->json(['errors'=>$validator->errors()->all()]);
            }

            $category = new Category();
            $category->name             = $request->category_name;
            $category->description      = $request->category_description;
            $category->status           = $request->status;
            $category->added_by         = $this->admin_id();

            $category->meta_title       = $request->meta_title;
            $category->keywords         = $request->keywords;
            $category->meta_description = $request->meta_description;
            
            if($category->save()){
                return Response()->json(['success'=>'Category Saved Successfully','name'=>$request->category_name,'id'=>$category->id]);
            }else{
                return Response()->json(['error'=>'Something went wrong. Please try again.']);
            }
            
        }else{
            $categories = Category::select('id','name')->get();
            return view('backend.category.add-category',['categories'=>$categories]);
        }
    }


    public function all()
    {
        $categories = Category::all()->sortByDesc('id');
        return View::make('backend.category.all',['categories'=>$categories]);
    }
}
