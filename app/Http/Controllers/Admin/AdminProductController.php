<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|unique:products,name',
            'price'=>'required|numeric|min:0',
            'category_id'=>'required|exists:categories,id',
            'description'=>'nullable|string',
            'image'       => 'nullable|mimes:jpg,jpeg,png,gif,webp,avif|max:2048',
            'stock'=>'required|integer|min:0',
        ]);
        $data['slug']=Str::slug($data['name']);
        $data['is_active']=$request->has('is_active');

        if($request->hasFile('image')){
            $data['image']=$request->file('image')->store('products','public');
        }

        Product::create($data); 
        return redirect()->route('admin.products.index')->with('success','Product created successfully');
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'=>'required|string|unique:products,name,'.$product->id,
            'price'=>'required|numeric|min:0',
            'category_id'=>'required|exists:categories,id',
            'description'=>'nullable|string',
            'is_active'=>'sometimes|boolean',
            'image'=>'nullable|image|max:2048',
            'stock'=>'required|integer|min:0',
        ]);
        $data['slug']=Str::slug($data['name']);
        $data['is_active']=$request->has('is_active');

        if($request->hasFile('image')){
            $data['image']=$request->file('image')->store('products','public');
        }

        $product->update($data); 
        return redirect()->route('admin.products.index')->with('success','Product updated successfully');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted successfully');
    }
}
