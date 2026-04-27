<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->category){
            $query->whereHas('category', fn($q)=>
            $q->where('slug', $request->category)
            );
        }
        if($request->search){
            $query->where('name','like','%'.$request->search.'%');

        }

        $products = $query->paginate(12);
        $categories = Category::all();
        return view('shop.index',compact('products','categories'));

    }


    /**
     * Show the form for creating a new resource.
     */
    
    
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return view('shop.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    
}
