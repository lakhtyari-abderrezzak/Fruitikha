<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Categories;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // using user HasMany
        $products = Auth::user()->products()->latest()->paginate(6);
        $categories = Categories::all();
        $carts = Cart::with(['product', 'user'])->get();
        return view('user.dashboard',['products' => $products, 'categories' => $categories, 'carts' => $carts]);
    }
    public function userProduct(User $user){
        // dd($user->products);
        $products = $user->products()->latest()->paginate(6);
        return view('user.products', [
            'products' => $products,
            'user' => $user,
        ]);

    }public function profile(User $user){
        return view('user.profile');

    }
}
