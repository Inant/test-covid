<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @internal
 * @coversNothing
 */
class TipeTest extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tipe_test';

    protected $primaryKey = 'id_tipe';

    public function pemeriksaan()
    {
        $this->hasMany(Pemeriksaan::class, 'tipe_pemeriksaan');
    }
}
