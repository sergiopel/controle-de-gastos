<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Despesas
            ['name' => 'Alimentação', 'type' => 'expense', 'is_system' => true],
            ['name' => 'Transporte', 'type' => 'expense', 'is_system' => true],
            ['name' => 'Moradia', 'type' => 'expense', 'is_system' => true],
            ['name' => 'Saúde', 'type' => 'expense', 'is_system' => true],
            
            // Receitas
            ['name' => 'Salário', 'type' => 'income', 'is_system' => true],
            ['name' => 'Investimentos', 'type' => 'income', 'is_system' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
