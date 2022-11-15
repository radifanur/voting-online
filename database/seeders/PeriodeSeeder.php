<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periode')->insert([
            'tahun' => date('2021-2022'),
            'mulai' => date('Y-m-d'),
            'akhir' => date('Y-m-d'),
        ]);
        
    }
}
