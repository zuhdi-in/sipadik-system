<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';
    
    protected $fillable = [
        'nomor_surat','perihal','tanggal_keluar','penerima','berkas','keterangan'
    ];
    
    public function suratkeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }
}
