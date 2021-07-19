<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function getTglPemeriksaanAttribute($value)
    {
        Carbon::setLocale('id');

        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->isoFormat('dddd, D MMMM Y');
    }
}
