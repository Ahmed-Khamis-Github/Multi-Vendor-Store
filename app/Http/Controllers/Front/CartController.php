<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        
       $items = $cart->get() ;

  
       $total = $cart->total() ;
       
       return view('front.cart',compact('items','total')) ;
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , CartRepository $cart) 
    {
        // dd($request) ;
        $request->validate([
            'product_id'=>['required','int','exists:products,id'] ,
            'quantity'=>['nullable','int','min:1']
        ]) ;
        $product = Product::findOrFail($request->post('product_id')) ; 
        $cart->add($product , $request->post('quantity')) ;

        return redirect()->route('cart.index') ;
    }

    

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepository $cart , $id)
    {
        $request->validate([
             'quantity'=>['required','int','min:1']
        ]) ;
         $cart->update($id , $request->post('quantity')) ;


         
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, $id)
    {
        $cart->delete($id) ;
    }
}
