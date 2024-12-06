<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('product') // Assuming you have a relation set up
                    ->where('user_id', Auth::id()) // Get the current authenticated user's ID
                    ->get();
        $products = Product::latest()->paginate(9);
        
        return view('products.index', ['products' => $products, 'carts' => $carts]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validate 
        $feilds = $request->validate([
            'name'=> 'required|min:3',
            'categories_id' => 'required',
            'price' => 'required|numeric',
            'quntity' => 'required|numeric',
            'img_url' => 'nullable|file|max:5000|mimes:png,jpg,webp',
        ]);
        // Check if image exists
        $path = $product->img_url ?? null;

        if($request->hasFile('img_url')) {
            $path = Storage::disk('public')->put('product_img', $request->img_url);
        }
        // hard code userid and catiid until further notice
        $userId = Auth::id();
        // Creat Product Post 
        Product::create([
            'user_id' => $userId,
            'categories_id' => $request->categories_id,
            'name'=> $request->name,
            'price'=> $request->price,
            'quntity'=> $request->quntity,
            'img_url' => $path,
            ]);
       
        // Redirect 
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // only authorized users can access edit 
        Gate::authorize('modify', $product);
        $categories = Categories::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // only authorized users can access  
        Gate::authorize('modify', $product);
        // Validate 
        $feilds = $request->validate([
            'name'=> 'required|min:3',
            'categories_id' => 'required',
            'price' => 'required|numeric',
            'quntity' => 'required|numeric',
            'img_url' => 'nullable|file|max:5000|mimes:jpg,png,webp',
        ]);
        // Check if image exists
        $path = $product->img_url ?? null;
        if($request->hasFile('img_url')) {
            if($product->img_url){
                Storage::disk('public')->delete($product->img_url);
            }
            $path = Storage::disk('public')->put('product_img', $request->img_url);
        }
        $userId = Auth::id();
        // Creat Product Post 
        $product->update([
            'user_id' => $userId,
            'categories_id' => $request->categories_id,
            'name'=> $request->name,
            'price'=> $request->price,
            'quntity'=> $request->quntity,
            'img_url' => $path,
            ]);

        // Redirect 
        return redirect()->route('user.dashboard')->with('success', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // only authorized users can access edit 
        Gate::authorize('modify', $product);
        // check if we have image then Delete it before product
        if($product->img_url){
            Storage::disk('public')->delete($product->img_url);
        }
        // Delete 
        $product->delete();
        // Redirect
        return back()->with('Delete', 'Your Post Was Deleted Successfully');
    }
}
