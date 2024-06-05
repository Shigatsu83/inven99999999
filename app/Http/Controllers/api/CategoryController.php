<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        $data = array("data" => $category);

        return response()->json($data);

    }
    public function show(string $id){
        $category = Category::where('id', $id)->first();
        $data = array("data" => $category);
        if ($category == null){
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json($data);
    }
    public function store(Request $request){
        $validatedData = Validator::make($request->all(), [
            'category' => 'required|in:A,M,BHP,BTHP',
            'description' => 'required|max:255',
        ]);
        if ($validatedData->fails()){
            return response()->json($validatedData->errors(), 422);
        }
        $insertData = Category::create($request->all());
        return response()->json(['message' => 'Kategori berhasil ditambahkan']);
    }
    public function update(Request $request, string $id){
        $validatedData = Validator::make($request->all(), [
            'category' => 'required|in:A,M,BHP,BTHP',
            'description' => 'required|max:255',
        ]);
        if ($validatedData->fails()){
            return response()->json($validatedData->errors(), 422);
        }
        if(!$category = Category::find($id)){
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $updateData = Category::where('id', $id)->update($request->all());
        return response()->json(['message' => 'Kategori berhasil diubah']);
    }
    public function destroy($id){
        $deleteData = Category::where('id', $id)->delete();
        if ($deleteData == 0){
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
