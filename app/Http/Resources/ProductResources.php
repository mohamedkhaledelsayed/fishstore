<?php

namespace App\Http\Resources;

use App\Attribute;
use App\Review;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResources extends JsonResource
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
            
            'productimages'=> json_decode(json_encode($this->images)), 
            'productname'  =>   $this->name,  
            'price'=> $this->price, 
            'offer_price'=> $offer_price, 
            'rating_avg'=> $productrating, 
            'descreption'=> $this->descreption, 
            'reviwes'=> $this->Reviwes()->with('user:id,name')->where('massage','!=',null)->get(), 
            'favourite'=>$this->isUserFavourite,

        ];
    }
}
