<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemeriksaan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'detail_pemeriksaan';

    protected $primaryKey = 'id_detail';

    protected $fillable = ['id_pemeriksaan','tipe_pemeriksaan','hasil'];
}
