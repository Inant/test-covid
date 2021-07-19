<?php

namespace Database\Seeders;

use App\Models\DetailPemeriksaan;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\TipeTest;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pasien::factory()->count(20)->create();
        Dokter::factory()->count(5)->create();
        TipeTest::insert([
            [
                'tipe' => 'IMUNOSEROLOGI',
                'nilai_normal' => 'NON REAKTIF',
            ], [
                'tipe' => 'RAPID TEST COVID - 19',
                'nilai_normal' => 'NON REAKTIF',
            ], [
                'tipe' => 'igG COVID - 19',
                'nilai_normal' => 'NON REAKTIF',
            ], [
                'tipe' => 'igM COVID - 19',
                'nilai_normal' => 'NON REAKTIF',
            ],
        ]);
        $pemeriksaan = [];
        for ($i = 0; $i < 5; ++$i) {
            $pemeriksaan[] = [
                'id_pasien' => random_int(5, 10),
                'id_dokter' => random_int(1, 5),
                'tgl_pemeriksaan' => now('Asia/Jakarta'),
                'keterangan' => 'tidak ada keterangan untuk sementara',
                'no_reg' => 'nomer registrasi '.$i,
                'pengirim' => 'iyek',
            ];
        }
        Pemeriksaan::insert($pemeriksaan);

        for ($i = 1; $i < 6; ++$i) {
            DetailPemeriksaan::insert([
                [
                    'id_pemeriksaan' => $i,
                    'hasil' => 'NON REAKTIF',
                    'tipe_pemeriksaan' => 1,
                ],
                [
                    'id_pemeriksaan' => $i,
                    'hasil' => 'NON REAKTIF',
                    'tipe_pemeriksaan' => 2,
                ],
                [
                    'id_pemeriksaan' => $i,
                    'hasil' => 'NON REAKTIF',
                    'tipe_pemeriksaan' => 3,
                ],
                [
                    'id_pemeriksaan' => $i,
                    'hasil' => 'NON REAKTIF',
                    'tipe_pemeriksaan' => 4,
                ],
            ]);
        }
    }
}
