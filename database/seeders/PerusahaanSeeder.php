<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perusahaan = [
            'PT INDONESIA FIBREBOARD INDUSTRY Tbk.',
            'PT WAHANA LESTARI MAKMUR SUKSES',
            'PT KASIH AGRO MANDIRI 1',
            'PT KASIH AGRO MANDIRI PKS',
            'PT BAYUNG AGRO SAWITA',
            'PT MUSI AGRO SEJAHTERA',
            'PT AGRONUSA BUMI LESTARI (MJE)',
            'PT INDONESIA FIBREBOARD INDUSTRY'
        ];
        
        for($i = 0; $i < count($perusahaan); $i++)
        {
            DB::table('ms_perusahaan')->insert([
                'perusahaan' => $perusahaan[$i]
            ]);
        }
    }
}
