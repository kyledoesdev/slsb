<?php

namespace Database\Seeders;

use App\Models\PCPart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PCPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PCPart::create(['name' => 'CPU', 'img_path' => '/img/1.png']);
        PCPart::create(['name' => 'GPU', 'img_path' => '/img/2.png']);
        PCPart::create(['name' => 'RAM', 'img_path' => '/img/3.png']);
        PCPart::create(['name' => 'PSU', 'img_path' => '/img/4.png']);
        PCPart::create(['name' => 'Storage', 'img_path' => '/img/5.png']);
        PCPart::create(['name' => 'Cooling', 'img_path' => '/img/6.png']);
        PCPart::create(['name' => 'Case', 'img_path' => '/img/7.png']);
        PCPart::create(['name' => 'Monitor', 'img_path' => '/img/8.png']);
        PCPart::create(['name' => 'Keyboard', 'img_path' => '/img/9.png']);
        PCPart::create(['name' => 'Mouse', 'img_path' => '/img/10.png']);
        PCPart::create(['name' => 'Headphones', 'img_path' => '/img/11.png']);
    }
}
