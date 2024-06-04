<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('kategori.index', compact('categories'));
    }

    public function show($id){
        $category = Category::find($id);
        return view('kategori.show', compact('category'));
    }
    public function create(){
        return view('kategori.create');
    }
    public function store(Request $request){
        $validatedReq = $request->validate([
            'category' => 'required|in:A,M,BHP,BTHP',
            'description' => 'required|min:5|max:255'
        ]);

        Category::create([
            'category' => $request->category,
            'description' => $request->description
        ]);
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }
    public function edit($id){
        $category = Category::find($id);
        return view('kategori.edit', compact('category'));
    }
    public function update(Request $request, $id){
        $validatedReq = $request->validate([
            'category' => 'required|in:A,M,BHP,BTHP',
            'description' => 'required|min:5|max:255'
        ]);

        Category::where('id', $id)->update([
            'category' => $request->category,
            'description' => $request->description
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }
    public function destroy(string $id){
        Category::destroy($id);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
