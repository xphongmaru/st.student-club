<?php

namespace Database\Seeders\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!DB::table('roles')->where('name', 'officer')->exists()) {
            DB::table('roles')->insert([
                'name' => 'officer',
                'created_at' => now(),
            ]);
        }

        if (!DB::table('role_permission')->where('role_id', '1')->where('permission_id','1')->exists()) {
            DB::table('role_permission')->insert([
                'role_id' => '1',
                'permission_id' => '1',
                'created_at' => now(),
            ]);
        }
    }
}
