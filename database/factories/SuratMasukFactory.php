<?php

namespace Database\Factories;

use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SuratMasuk::class;
    public function definition()
    {
        $jenisSuratId = JenisSurat::inRandomOrder()->first()->id;
        return [
            'nomor_surat' => $this->faker->unique()->regexify('SM/[A-Z]{3}/[0-9]{4}/[0-9]{2}'),
            'perihal' => $this->faker->sentence(5),
            'tanggal_surat' => $this->faker->date(),
            'pengirim' => $this->faker->company,
            'tanggal_diterima' => $this->faker->date(),
            'disposisi' => $this->faker->text,
            'berkas' => $this->faker->word,
            'keterangan' => $this->faker->text,
            'jenis_surat_id' => $jenisSuratId

        ];
    }
}
