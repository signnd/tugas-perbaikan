<?php

namespace Database\Seeders;

use App\Models\Perbaikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerbaikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perbaikan::factory()->count(3)->create();
    }
}
