<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SuratKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomor_surat' => $this->faker->unique()->regexify('SM/[A-Z]{3}/[0-9]{4}/[0-9]{2}'),
            'perihal' => $this->faker->sentence(5),
            'tanggal_keluar' => $this->faker->date(),
            'penerima' => $this->faker->company,           
            'berkas' => $this->faker->word,
            'keterangan' => $this->faker->text,
        ];
    }
}
