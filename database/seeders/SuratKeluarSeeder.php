<?php

namespace Database\Seeders;

use Database\Factories\SuratKeluarFactory;
use Illuminate\Database\Seeder;

class SuratKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuratKeluarFactory::new()->count(20)->create();
    }
}