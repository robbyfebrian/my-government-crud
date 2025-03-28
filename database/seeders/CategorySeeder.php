<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Permohonan Keringanan Pajak',
            'Permohonan Pembebasan Pajak',
            'Keringanan Denda Administrasi',
        ];

        foreach ($categories as $category) {
            Category::updateOrInsert(
                ['name' => $category],
                ['slug' => Str::slug($category)]
            );
        }
    }
}