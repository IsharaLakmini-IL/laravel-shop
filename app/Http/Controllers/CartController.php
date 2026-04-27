<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $items->sum(fn($i)=>$i->product->price*$i->quantity);
        return view('cart.index', compact('items','total'));
    }

    public function add(Request $request,Product $product)
    {
        $cart = Cart::where('user_id',auth()->id())
            ->where('product_id',$product->id)->first();

           if($cart){
                $cart->increment('quantity'); // increase quantity
            }else{
                Cart::create([
                    'user_id'=>auth()->id(),
                    'product_id'=>$product->id,
                    'quantity'=>1
                ]);
}
            return back()->with('success','Product added to cart');
    }

    public function update(Request $request,Cart $cart)
    {
        $cart->update([
            'quantity'=>max(1,$request->quantity)
        ]);
        return back()->with('success','Cart updated');
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
        return back()->with('success','Product removed from cart');
    }
}
