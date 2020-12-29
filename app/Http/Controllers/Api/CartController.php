<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Cart;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartResources;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
        $userid= auth('api')->user()->id;
        $cart = Cart::with('product')
        ->where('user_id',$userid)
        ->orderby('id', 'desc')
        ->get();
        $collect = CartResources::collection($cart);
        $total =  collect(CartResources::collection($cart))->sum('totalpricequantity');
         return response(['data' => $collect, 'total' => $total]);
    }
    public function deletefromcart(Request $request)
    {
        $product_id=$request->product_id;
        $request->validate([
            'product_id'=>'required|exists:products,id'
        ]);
        
        $deletefromcart= Cart::where('product_id',$product_id)->first();
        if(!$deletefromcart){
            return response()->json(['status'=>false,'massage'=>'product Not found']);

        }
        $deletefromcart->delete();

        return response()->json(['status'=>true,'massage'=>'product removed from the cart successfully']);
    }



    public function store(Request $request){
        $userid=auth('api')->user()->id;
        $request->validate([
            'product_id'=>'required|exists:products,id',

        ]);
        if ($request->quantity) {
            $quantity=$request->quantity;
        }else{
            $quantity=1;
        }
        
  
         $cart = Cart::updateOrCreate([
             'product_id'=>$request->product_id,
             'user_id'=>$userid
         ]);

         $cart->quantity = ($cart->quantity = $quantity);

         $cart->save();
         return response()->json(['status'=>true,'massage'=>'product added to  Cart successfully']);
        
    }
}
