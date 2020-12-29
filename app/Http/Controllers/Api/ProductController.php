<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ProductResources;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\CategoryResources;
use App\Product;
use App\Review;
use App\Attribute;
use DB;
use  App\Http\Resources\AttributeResources;
class ProductController extends Controller
{
    public function productinfo(Request $request)
    {
        $product =Product::where('id',$request->product_id)->first();

        $attributes = Attribute::whereHas('attributesValue', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->with(['attributesValue' => function($query ) use ($product){
            $query->where('product_id', $product->id);
        }])->get();
        $s = collect(new ProductResources($product));
        $m =  ['attribute' => collect(AttributeResources::collection($attributes))->toArray()];
           $p= array_merge($s->toArray(),$m);
         return response()->json(['data'=>$p]);
        
    }

    public function search(Request $request)
    {
        $search=$request->search;
        $proudcts=Product::whereTranslationLike('name', '%'.$search.'%')->with('translations')->get();

        return CategoryResources::collection($proudcts);

    }

    

    
}
