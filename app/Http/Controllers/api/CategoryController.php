<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function show(){
        $category = Category::all();
        $data = array("data" => $category);

        return response()->json($data);

    }
    public function insertNew(Request $request){
        $validatedData = Validator::make($request->all(), [
            'category' => 'required|in:A,M,BHP,BTHP',
            'description' => 'required|max:255',
        ]);
        if ($validatedData->fails()){
            return response()->json($validatedData->errors(), 422);
        }

        $insertData = Category::create($request->all());
        return response()->json(['message' => 'berhasil']);
    }
}
