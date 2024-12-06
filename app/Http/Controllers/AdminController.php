<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use App\Models\Cart;

class AdminController extends Controller
{
    
    public function index(Categories $categories){
        Gate::authorize('modify', $categories);
        $orders = Order::with(['product', 'user'])->latest()->get();
        $categories = Categories::all();
        return view('/admin/dashboard', ['categories' => $categories ,'orders' => $orders]);
    }
}
