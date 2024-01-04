<?php

namespace Database\Seeders;

use Database\Factories\JenisSuratFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisSuratFactory::new()->count(4)->create();
    }
}
