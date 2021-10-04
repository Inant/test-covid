<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanPcr extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_pcr';

    protected $primaryKey = 'id_pemeriksaan';

    protected $with = ['details'];

    protected $fillable = ['no_reg', 'id_pasien', 'id_dokter', 'keterangan', 'tgl_swab','tgl_diterima','tgl_validasi','tgl_cetak_hasil'];

    public function details()
    {
        return $this->hasMany(DetailPemeriksaanPcr::class, 'id_pemeriksaan');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function getFormatTglDiterimaAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->tgl_diterima)->locale('id')->isoFormat('D MMMM Y');
    }
}
