<?php

namespace App\Http\Resources;

use App\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $productrating= $this->Reviwes->where('product_id',$this->id)->pluck('rating')->avg();
        if($productrating == null){
            $productrating="0";
        }
        $offer_price=$this->offer_price;
        if( $offer_price==null){
          $offer_price= $this->offer_price="0";
        };
        
        return [
            'product_id'=>$this->id,
            'productimage'=>$this->image_cover,
            'productname'  =>   $this->name,  
            'price'=> $this->price, 
            'offer_price'=> $offer_price, 
            'rating_avg'=> $productrating, 
            'favourite'=>$this->isUserFavourite,
          ];
    }
}
