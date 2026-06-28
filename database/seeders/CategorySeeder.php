<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Website',
            'Game',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
            ]);
        }

        $this->command->info('2 categories berhasil di-seed!');
    }
}