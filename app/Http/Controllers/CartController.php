<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Illuminate\Log\log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        // Fetch all carts with the associated product
        $carts = Cart::with('product') // Assuming you have a relation set up
                    ->where('user_id', Auth::id()) // Get the current authenticated user's ID
                    ->get();
        // Calculate the total
        $totalPrice = $carts->sum(function ($item) {
            return $item->quantity * $item->product->price; // Calculate total for each item
        });
    
        return view('/cart', ['carts' => $carts, 'totalPrice' => $totalPrice]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $cart = Cart::updateOrCreate(
            attributes: ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            values: ['quantity' => DB::raw('quantity + ' . $request->quantity)]
        );
        if($cart){
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }else{
            return redirect()->back()->with('fail;', 'Failed to add product to cart!');
        }
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
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
    
        return redirect()->back()->with(['success', 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart ,$id)
    {
        $cart = Cart::find($id);
        // Delete Cart from Data Base
        $cart->delete();
        // Redirect Back 
        return redirect()->back()->with('Delete', 'Your Product Cart Was Deleted Successfully');
    }
}
