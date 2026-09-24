<?php

namespace Database\Seeders;

use  App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate(
            ['name' => 'Salário'],
            ['type' => 'income']
        );

        Category::updateOrCreate(
            ['name' => 'Freelance'],
            ['type' => 'income']
        );

        Category::updateOrCreate(
            ['name' => 'Alimentção'],
            ['type' => 'expense']
        );

        Category::updateOrCreate(
            ['name' => 'Aluguel'],
            ['type' => 'expense']
        );

        Category::updateOrCreate(
            ['name' => 'Lazer'],
            ['type' => 'expense']
        );
    }
}
