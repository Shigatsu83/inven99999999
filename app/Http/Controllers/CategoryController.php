<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $resetcategory=Kategori::all();
        // return $resetcategory; //nampilin semua
        // // return $resetcategory[4]->deskripsi; //nampilin deksirpisi kategori ke 4

        // return view('layouts.master',compact('resetcategory')); 
        return view('category.index',compact('resetcategory')); 

    }
}
