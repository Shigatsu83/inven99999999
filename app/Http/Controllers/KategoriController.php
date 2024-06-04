<?php

namespace App\Http\Controllers;

use App\Models\Kategori; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
    $rsetKategori = Kategori::getKategoriAll()->paginate(10);
    return view('kategori.index',compact('rsetKategori'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $akategori = array('blank'=>'Pilih Kategori',
                            'M'=>'Barang Modal',
                            'A'=>'Alat',
                            'BHP'=>'Bahan Habis Pakai',
                            'BTHP'=>'Bahan Tidak Habis Pakai'
                            );
        return view('kategori.create',compact('akategori'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'deskripsi'   => 'required | unique:kategori',
            'kategori'    => 'required | in:M,A,BHP,BTHP',
        ]);

        // buat kategori baru
        Kategori::create([
            'deskripsi'  => $request->deskripsi,
	        'kategori'   => $request->kategori,
        ]);
        
        //redirect ke kategori index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);
        return view('kategori.show', compact('rsetKategori'));
    }

    public function edit(string $id)
    {
        $rsetKategori = Kategori::find($id);
        return view('kategori.edit', compact('rsetKategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'deskripsi'   => 'required',
            'kategori'    => 'required',
        ]);

        $rsetKategori = Kategori::find($id);
            $rsetKategori->update([
                'deskripsi'  => $request->deskripsi,
                'kategori'   => $request->kategori,
            ]);
        return redirect()->route('kategori.index')->with(['success' => 'Data Kategori Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['gagal' => 'Data Gagal Dihapus! Data masih digunakan']);            
        } else {
        $rsetKategori = Kategori::find($id);
        $rsetKategori->delete();
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
