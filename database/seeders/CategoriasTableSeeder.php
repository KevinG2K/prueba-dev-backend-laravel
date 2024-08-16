<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('categorias')->insert([
            ['nombre' => 'Categoria A', 'descripcion' => 'Productos de categoria A.', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Categoria B', 'descripcion' => 'Productos de categoria B.', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Categoria C', 'descripcion' => 'Productos de categoria C.', 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Categoria D', 'descripcion' => 'Productos de categoria D.', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
