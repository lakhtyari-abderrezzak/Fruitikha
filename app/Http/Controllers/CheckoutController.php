<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function index(){
        
        return view('checkout.index');
    }
    public function payment(){
        $carts = Cart::with('product') // Assuming you have a relation set up
                    ->where('user_id', Auth::id()) // Get the current authenticated user's ID
                    ->get();

        // Calculate the total
        $totalPrice = $carts->sum(function ($item) {
            return $item->quantity * $item->product->price; // Calculate total for each item
        });
        return view('checkout.payment', ['carts' => $carts, 'totalPrice' => $totalPrice]);
    }
    public function order(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|string|max:15',
        ]);
        $cart = Cart::with('product') // Assuming you have a relation set up
                    ->where('user_id', Auth::id()) // Get the current authenticated user's ID
                    ->get();
        foreach($cart as $carts){
            $order = new Order;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->status = 'In Progress';
            $order->user_id = Auth::id();
            $order->product_id = $carts->product->id;
            $order->save();
        }
        return redirect()->route('checkout.payment') ;
    }
    public function stripe($totalPrice){
        
        return view('checkout.stripe', compact('totalPrice'));
    
    }
    public function stripePost($totalPrice)
{
    // Set your secret key
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create a charge
    $charge = Charge::create([
        'amount' => $totalPrice * 100, // Amount in cents (e.g., 1000 = $10)
        'currency' => 'usd',
        'source' => 'tok_visa', // This should be a token obtained from Stripe.js on the frontend
        'description' => 'Test charge',
    ]);
    Order::all()->each(function ($order) {
        $order->payment_status = 'Paid';
        $order->save();
    });

    $carts = Cart::where('user_id', Auth::id())->get();
    foreach($carts as $removeCart){
        $data = Cart::find($removeCart->id);
        $data->delete();
    }

    return redirect()->route('checkout.payment')->with('success', 'Payment was successful!');
}
}
