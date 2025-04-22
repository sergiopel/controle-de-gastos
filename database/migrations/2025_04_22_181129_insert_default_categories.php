<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
            DB::table('categories')->insert($category);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->whereIn('name', [
            'Alimentação', 'Transporte', 'Moradia', 'Saúde', 
            'Salário', 'Investimentos'
        ])->where('is_system', true)->delete();
    }
};
