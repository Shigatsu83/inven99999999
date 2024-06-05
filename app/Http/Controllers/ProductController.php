<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Category;

//import return type View
use App\Models\Product; 

//import return type redirectResponse
use Illuminate\View\View;

//import Http Request
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $products = Product::latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));

    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $categoryId= Category::all();
        return view('products.create', compact('categoryId'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'category_id'   => 'required',
            'description'   => 'required|min:1',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products/', $image->hashName());
        //create product
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'category_id'   => $request->category_id, //change to 'category_id
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function show(string $id){
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(string $id){
        $product = Product::findOrFail($id);
        $categoryId = Category::all();

        //render view with product
        return view('products.edit', compact('product', 'categoryId'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png|max:5000',
            'title' => 'required|min:4|max:100',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/products/', $image->hashName());

            //delete old image
            Storage::delete('public/products/'.$product->image);

            //update product with new image
            $product->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);

        } else {

            //update product without image
            $product->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);
        }
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diedit!']);
    }

    public function destroy(string $id){
        $product = Product::findOrFail($id);

        Storage::delete('public/products/'. $product->image);
        $product->delete();
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);

    }
}