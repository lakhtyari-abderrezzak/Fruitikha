<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function change(Request $request, $id)
    {
        
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back();
        
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        // Delete Cart from Data Base
        $order->delete();
        // Redirect Back 
        return redirect()->back()->with('Delete', 'Your Product Cart Was Deleted Successfully');
    }

}
