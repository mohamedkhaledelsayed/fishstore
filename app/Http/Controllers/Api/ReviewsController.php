<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use App\Product;

class ReviewsController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'product_id'=>'required|exists:products,id',
            'rating'=>'required|numeric|between:0,5'
        ]);
           $userid= $request->user()->id;
         Review::updateOrCreate([
            'product_id'=>$request->product_id,
            'user_id'=>$userid,
            'rating'=>$request->rating,
            'massage'=>$request->massage,
        ]);
  
        return response()->json(['status'=>true,'massage'=>'Product Reviewed successfully']);
        
    }
}
