<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Http\Resources\CategoryCollection;

use App\Http\Resources\CategoryResources;
class CategoryController extends Controller
{
    public function categories()
    {

        $category = Category::get();
        return response()->json(['status'=>true,'data'=>$category],200);
    }
    public function category(Request $request)
    {
        $category=Category::with('products')->findOrfail($request->cat_id);
        $search=$request->search;

        $proudcts=Product::whereTranslationLike('name', '%'.$search.'%')->with('translations')->where('cat_id',$request->cat_id)->get();
        
    
    
        
         return CategoryResources::collection($proudcts);
       
    }
}
