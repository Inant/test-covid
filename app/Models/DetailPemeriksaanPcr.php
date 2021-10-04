<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemeriksaanPcr extends Model
{
    use HasFactory;

    protected $table = 'detail_pemeriksaan_pcr';

    public $timestamps = false;

    protected $primaryKey = 'id_detail';

    protected $fillable = ['id_pemeriksaan','tipe_pcr','hasil'];

    public $with = ['tipePcr'];

    public function tipePcr() {
        return $this->belongsTo(TipePcr::class,'tipe_pcr');
    }
}
