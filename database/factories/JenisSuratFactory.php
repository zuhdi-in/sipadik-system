<?php

namespace Database\Factories;

use App\Models\JenisSurat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JenisSuratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $jenisSuratData = [
        'Surat Keputusan',
        'Surat Pernyataan',
        'Surat Kuasa',
        'Surat Pemberitahuan'
    ];

    protected $model = JenisSurat::class;
    private $currentIndex = 0;
    public function definition()
    {
        $jenisSurat = $this->jenisSuratData[$this->currentIndex];

        $this->currentIndex = ($this->currentIndex + 1) % count($this->jenisSuratData);

        return [
            'nama_jenis' => $jenisSurat,
            // Sesuaikan dengan struktur tabel Anda
        ];
    }
}
