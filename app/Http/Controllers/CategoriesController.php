<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function show($id)
    {
        $category = Categories::find($id);
        return view('categories.show', ['category' => $category]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Categories $categories)
    {

        Gate::authorize('modify', $categories);
        // Validate 
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'img_path' => 'nullable|file|max:7000|mimes:png,jpg,webp',
        ]);
        // Check if image exists
        $path = $categories->img_path ?? null;
        if ($request->hasFile('img_path')) {
            if ($categories->img_path) {
                Storage::disk('public')->delete($categories->img_path);
            }
            $path = Storage::disk('public')->put('categories_img', $request->img_path);
        }

        Categories::create([
            'name' => $request->name,
            'description' => $request->description,
            'img_path' => $path,
        ]);


        // Redirect 
        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */

    public function catProduct( $category)
    {
        $categories = Categories::with('products')->find($category);
        $products = Product::where('categories_id', $category)->get();
        return view('categories.catProduct', [
            'products' => $products,
            'categories' => $categories
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories, $id)
    {
        // only authorized users can access  
        Gate::authorize('modify', $categories);

        $categories = Categories::find($id);
        // eidt view
        return view('categories.edit', ['categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories,$id)
    {
        // only authorized users can access  
        Gate::authorize('modify', $categories);
        $categories = Categories::find($id);

        // Validate 
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'img_path' => 'nullable|file|max:7000|mimes:jpg,png,webp',
        ]);
        // Check if image exists
        $path = $categories->img_path ?? null;
        if ($request->hasFile('img_path')) {
            if ($categories->img_path) {
                Storage::disk('public')->delete($categories->img_path);
            }
            $path = Storage::disk('public')->put('categories_img', $request->img_path);
        }

        $categories->update([
            'name' => $request->name,
            'description' => $request->description,
            'img_path' => $path,
        ]);

        // Redirect 
        return redirect()->route('admin.dashboard')->with('success', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categories = Categories::find(id: $id);
        // only authorized users can access edit 
        Gate::authorize('modify', $categories);
        // check if we have image then Delete it before product
        $categories->delete();
        //redirect
        return redirect()->route('dashboard')->with('Delete', 'Category Deleted successfully!');

    }
}
