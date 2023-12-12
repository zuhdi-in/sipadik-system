<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    
    protected $fillable = [
        'nomor_surat', 'perihal', 'tanggal_surat', 'pengirim','tanggal_diterima','disposisi','berkas','keterangan'
    ];


    public function suratmasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }
}
