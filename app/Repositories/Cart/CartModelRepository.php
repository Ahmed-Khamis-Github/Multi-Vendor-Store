<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class CartModelRepository implements CartRepository
{

    protected $items ; 

    public function __construct()
    {
        $this->items = collect();

    }


    public function get(): Collection
    {
        if ($this->items->isEmpty()) {
            $this->items = Cart::with('product')->get();
        }
        
        return $this->items;
    }
     
    
    
    
    
    

    public function add(Product $product, $quantity = 1)
    {

        $item =Cart::where('product_id', '=', $product->id)->first() ;

        if(!$item) {
       return Cart::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
             'quantity' => $quantity
        ]);
    }

    return $item->increment('quantity',$quantity) ;
    }

    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)->update([
            'quantity' => $quantity
        ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)->delete();
    }


    public function empty()
    {
        cart::query()->delete() ;
    }

    public function total ( )  
    
    {
 

   return $this->get()->sum(function($item){
 
        return $item->quantity * $item->product->price ;
    }) ;
    }

   
}
