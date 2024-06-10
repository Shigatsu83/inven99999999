<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_keluar',
        'qty',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
