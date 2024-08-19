<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Todo',
            'InProgress',
            'Testing',
            'Done',
            'Pending',
        ];

        foreach ($categories as $category) {
            DB::table('category')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'nuzul',
                'updated_by' => 'nuzul',
            ]);
        }
    }
}
