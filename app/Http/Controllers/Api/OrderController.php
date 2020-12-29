<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Government;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
Use App\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createorders(Request $request)
    {
        $datacart=Cart::where('user_id', auth('api')->user()->id)->get();
        if(!$datacart->count()){
            abort(404);
        };
        $request->validate([
           
            'government_id'=>'required|exists:governments,id',
            'city_id'=>'required|exists:cities,id',
            'phone_number'=>'required|numeric',
        ]);
        $ordersdetails = [];
        $userid=$request->user()->id;
        $products =Product::whereIn('id',$datacart->pluck('product_id'))->select('id','price')->get();
        
        $total=0;
        foreach($products as $product){

             $current_product = $datacart->where('product_id',$product['id'])->first();

                if(!$current_product) {
                    return response()->json(['massage'=>'this product Doesn\'t exist'],422);
                }
            $ordersdetails[] = [
                'product_id'=>$product->id,
                'quantity'=>$current_product->quantity,
                'price'=> $product->price,
            ];

          
            $total+=$product->price * $current_product->quantity;
        
    }
        $order = Order::create([
            'government_id'=>$request->government_id,
            'city_id'=>$request->city_id,
            'phone_number'=>$request->phone_number,
            'addressdetails'=>$request->addressdetails,
            'user_id' =>$userid,
            'total'=>$total
            ]);
        $order->ordersdetails()->createMany($ordersdetails);
        if($order){
            Cart::destroy($datacart->pluck('id'));
        }
        return response()->json(['status'=>true,'massage'=>'Product Added successfully']);

    }



  


    public function governments()
    {
        $governments = Government::get();
        $data = [
            "status" => true,
            "data" => [
               
            ]
        ];
        return Response(["status" => true,'data'=>$governments]);
      
        
        
    }
    public function cities(Request $request)
    {
        $gov_id =$request->gov_id;
        $cities = City::where('gov_id',$gov_id)->get();
        return response()->json(['status'=>true,'data'=>$cities]);
    }

}
