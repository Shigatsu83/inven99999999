<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangMasuks = BarangMasuk::latest()->paginate(5);
        return view('inproducts.index', compact('barangMasuks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productId = Product::all();
        return view('inproducts.create', compact('productId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_masuk' => 'required',
            'qty' => 'required',
            'product_id' => 'required',
        ]);

        BarangMasuk::create($request->all());
        return redirect()->route('inproducts.index')
            ->with('success', 'Barang Masuk created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk, string $id)
    {
        $item = BarangMasuk::find($id);
        return view('inproducts.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productOption = Product::all();
        $barangMasuk = BarangMasuk::find($id);
        return view('inproducts.edit', compact('barangMasuk', 'productOption'));           //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tgl_masuk' => 'required',
            'qty' => 'required',
        ]);

        $barangMasuk = BarangMasuk::find($id);
        $barangMasuk->update($request->all());
        return redirect()->route('inproducts.index')
            ->with('success', 'Barang Masuk updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangMasuk = BarangMasuk::find($id);
        $barangMasuk->delete();
        return redirect()->route('inproducts.index')
            ->with('success', 'Barang Masuk deleted mewingly.');
    }
}
