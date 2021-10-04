<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePcr extends Model
{
    use HasFactory;
    protected $table = 'tipe_pcr';

    public $timestamps = false;

    protected $primaryKey = 'id_tipe';

    public function pemeriksaanPcr()
    {
        $this->hasMany(PemeriksaanPcr::class, 'tipe_pemeriksaan');
    }
}
