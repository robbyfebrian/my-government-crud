<?php

namespace Database\Seeders;

use App\Models\Mail;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $categories = Category::all();

        if ($categories->isEmpty()) {
            return;
        }

        Mail::factory(100)->create();
    }
}