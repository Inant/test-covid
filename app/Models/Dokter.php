<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dokter';

    protected $primaryKey = 'id_dokter';

    public function pemeriksaan()
    {
        $this->hasMany(Pemeriksaan::class, 'id_dokter');
    }
    
    public function pemeriksaanPcr()
    {
        $this->hasMany(PemeriksaanPcr::class, 'id_dokter');
    }
}
