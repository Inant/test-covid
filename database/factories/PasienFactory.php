<?php

namespace Database\Factories;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pasien::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nik' => $this->faker->randomNumber(),
            'nama_pasien' => $this->faker->userName(),
            'umur' => random_int(20, 30),
            'alamat' => $this->faker->streetAddress(),
        ];
    }
}
