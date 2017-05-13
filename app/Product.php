<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use PayPal\Api\Item;

class Product extends Model
{

    public function paypalItem(){
    	$item = new Item();
    		$item->setName($this->title)
    				 ->setDescription($this->description)
    				 ->setCurrency('USD')
    				 ->setQuantity(1)
    				 ->setPrice($this->pricing / 100);
		return $item;
    }

    public function scopeLatest($query){
      return $query->orderBy('id', 'desc');
    }

}
