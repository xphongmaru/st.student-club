<?php

namespace Database\Seeders\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!DB::table('permissions')->where('name', 'Quản lý câu lạc bộ')->exists()) {
            DB::table('permissions')->insert([
                'name' => 'Quản lý câu lạc bộ',
                'created_at' => now(),
            ]);
        }
    }
}
