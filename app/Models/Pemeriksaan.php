<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pemeriksaan';

    protected $primaryKey = 'id_pemeriksaan';

    protected $with = ['details'];

    protected $fillable = ['no_reg', 'id_pasien', 'id_dokter', 'keterangan', 'tgl_pemeriksaan'];

    public function details()
    {
        return $this->hasMany(DetailPemeriksaan::class, 'id_pemeriksaan');
    }
}
