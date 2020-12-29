<?php

namespace App\Http\Resources;

use App\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResources extends JsonResource
{
    protected $total = 0;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      
        $totalPricec = $this->product->CurrentPrice * $this->quantity;
        $this->total += $totalPricec;
        return [
            'id'=>$this->product->id,
            'productimage'=>$this->product->image_cover,
            'productname'  =>   $this->product->name,  
            'quantity' =>$this->quantity,
            'price'=>$this->product->CurrentPrice, 
            'totalpricequantity'=>$totalPricec
        
        
        ];
    }
}
