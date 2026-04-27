<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        $items = Cart::with('product')
            ->where('user_id',auth()->id())->get();

            if($items->isEmpty())
                return back()->with('error', 'Cart is empty');

        $total = $items->sum(fn($i)=>$i->product->price*$i->quantity);
        return view('orders.checkout',compact('items','total'));
    }


    public function store(Request $request)
    {
        $request ->validate(['shipping_address'=>'required|string']);

        $items = Cart::with('product')
            ->where('user_id',auth()->id())->get();

        $total = $items->sum(fn($i)=> $i ->product->price*$i->quantity);

        $order = Order::create([
            'user_id'=>auth()->id(),
            'total_amount'=>$total,
            'shipping_address'=>$request->shipping_address,
            'status'=>'pending',
        ]);

        foreach($items as $item){
            $order->items()->create([
                'product_id'=>$item->product_id,
                'quantity'=>$item->quantity,
                'price'=>$item->product->price,
            ]);
            $item->product->decrement('stock',$item->quantity);

            Cart::where('user_id',auth()->id())->delete();

            return redirect()->route('orders.show',$order)->with('success','Order placed successfully');
        }
    }

        public function show(Order $order)
        {
            $order->load('items.product');
            return view('orders.show',compact('order'));
        }
    
        public function history()
        {
            $orders = Order::where('user_id',auth()->id())->latest()->paginate(10);
            return view('orders.history',compact('orders'));
        }

        
    }

   
