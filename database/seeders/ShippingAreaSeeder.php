<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            ['name' => 'Medan', 'cost' => 10000],
            ['name' => 'Binjai', 'cost' => 15000],
            ['name' => 'Deli Serdang', 'cost' => 15000],
            ['name' => 'Langkat', 'cost' => 20000],
            ['name' => 'Tebing Tinggi', 'cost' => 25000],
            ['name' => 'Serdang Bedagai', 'cost' => 25000],
            ['name' => 'Asahan', 'cost' => 30000],
            ['name' => 'Pematang Siantar', 'cost' => 30000],
            ['name' => 'Simalungun', 'cost' => 35000],
            ['name' => 'Tanjung Balai', 'cost' => 35000],
            ['name' => 'Labuhanbatu', 'cost' => 40000],
            ['name' => 'Tapanuli Utara', 'cost' => 50000],
            ['name' => 'Sibolga', 'cost' => 55000],
            ['name' => 'Padang Sidempuan', 'cost' => 60000],
            ['name' => 'Mandailing Natal', 'cost' => 70000],
            ['name' => 'Gunungsitoli (Nias)', 'cost' => 85000],
        ];

        foreach ($areas as $area) {
            \App\Models\ShippingArea::create([
                'name' => $area['name'],
                'cost' => $area['cost'],
                'is_active' => true,
            ]);
        }
    }
}
