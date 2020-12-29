<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->product->id,
            'productimage'=>$this->product->image_cover,
            'productname'  =>   $this->product->name,  
            'price'=> $this->product->price, 
            'offer_price'=> $this->product->offer_price, 
            'rating_avg'=> $this->product->rating_avg, 
        ];
    }
}
