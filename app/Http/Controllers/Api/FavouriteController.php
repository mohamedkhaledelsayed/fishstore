<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Favourite;
use App\Http\Resources\FavouriteCollection;
use App\Http\Resources\FavouriteResources;
use App\Product;
use App\User;
class FavouriteController extends Controller
{

    public function wishlist(Request $request)
    {
        $userid= auth('api')->user()->id;
        $wishlists = Favourite::with('product')
        ->where('user_id',$userid)
        ->orderby('id', 'desc')
        ->get();
      
         return FavouriteResources::collection($wishlists);

    }
    public function like(Request $request)
    {
        $userid=auth('api')->user()->id;
        $request->validate([
            'product_id'=>'required|exists:products,id',
        ]);
         Favourite::updateOrCreate([
            'product_id'=>$request->product_id,
            'user_id'=>$userid
         ]);

         return response()->json(['status'=>true,'massage'=>'product added to the wishlist successfully']);
    }
    public function unlike(Request $request)
    {
        $product_id=$request->product_id;
        $request->validate([
            'product_id'=>'required|exists:products,id'
        ]);
        
        $unlike= Favourite::where('product_id',$product_id)->first();
        if(!$unlike){
            return response()->json(['status'=>false,'massage'=>'product Not found'],400);
        }
        $unlike->delete();

        return response()->json(['status'=>true,'massage'=>'product removed from the wishlist successfully']);
    }
}
