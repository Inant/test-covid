<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\TipePcr;

class TipePcrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipePcr::insert([
            [
                'tipe_pcr' => 'SARS-CoV-2 Nucleic Acid Test (RT-PCR)',
                'nilai_rujukan' => 'NEGATIF',
            ],
        ]);
    }
}
