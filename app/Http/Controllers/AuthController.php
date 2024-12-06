<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request){
        // Validate
        $fields = $request->validate([
            'username' => 'required|min:3',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:3|confirmed',
            'user_img' => 'nullable|file|max:5000|mimes:png,jpg,webp',
        ]);
        // Check if image exists
        $path = $product->img_url ?? null;

        if($request->hasFile('user_img')) {
            $path = Storage::disk('public')->put('users_img', $request->user_img);
        }
        // Register
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'user_img' => $path,
        ]);
        // Login
        Auth::login($user);
        // Redirect
        return redirect()->intended();
    }
    public function edit()
    {
       return view('user.edit');
    }
    public function update(Request $request, $id){
        
        // only authorized users can access  
        $user = User::find($id);

        // Validate 
        $fields = $request->validate([
            'username' => 'required|min:3',
            'email' => 'required|max:255|email',
            'password' => 'required|min:3|confirmed',
            'user_img' => 'nullable|file|max:5000|mimes:png,jpg,webp',
        ]);
        // Check if image exists
        $path = $user->user_img ?? null;
        if ($request->hasFile('user_img')) {
            if ($user->user_img) {
                Storage::disk('public')->delete($user->user_img);
            }
            $path = Storage::disk('public')->put('user_img', $request->user_img);
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'user_img' => $path,
        ]);
        
        return redirect()->route('user.profile')->with('success', 'Profile Updated Successfully');
    }
    public function login(Request $request){
        // Validate
        $fields = $request->validate([
            'email' => 'required|max:255|email',
            'password' => 'required',
            'status' => 'status|in:user,admin',
        ]);
        // Login
       if(Auth::attempt($fields,$request->remember)){
        $user = Auth::user();
        
        // Redirect based on user role
        return redirect($user->isAdmin() ? '/admin/dashboard' : '/user/dashboard');
       }else{
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records'
            ]);
       };
    }
    public function logout(Request $request){
        // Log user out
        Auth::logout();
        // Invalidate session
        $request->session()->Invalidate();
        // Regenrate @crcf Token
        $request->session()->regenerateToken();
        //Redirect user
        return redirect('/login');

    }
}
