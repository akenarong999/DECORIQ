<?php

namespace App;


class Cart
{
  public $items = null;
  public $totalQty = 0;
  public $totalPrice = 0;

  public function __construct($oldCart)
  {
      if($oldCart){
        $this->items = $oldCart->items;
      }
  }

  public function add($item, $id, $quantity,$addedTime,$product_variation_price){
    $storedItem = ['id'=>$id,'qty'=>0,'store_id'=>$item->store_id,'type'=>$item->product_type,'addedTime'=>$addedTime ];
    if($this->items){
      if(array_key_exists($id, $this->items)){
        $storedItem = $this->items[$id];
      }
    }
    $storedItem['id'] =$id;
    $storedItem['qty'] = $storedItem['qty']+$quantity;
    $storedItem['store_id'] = $item->store_id;
    $storedItem['type'] = $item->product_type;
    $this->items[$id] = $storedItem;

  }
}
