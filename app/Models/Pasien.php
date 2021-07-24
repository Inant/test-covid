<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $fillable = ['nik', 'nama_pasien', 'umur', 'alamat'];
}
