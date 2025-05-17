<?php

namespace Database\Seeders\Club;

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
        if (!DB::table('permission_clubs')->where('name', 'Quản lý chức vụ')->exists()) {
            DB::table('permission_clubs')->insert([
                'name' => 'Quản lý chức vụ',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('permission_clubs')->where('name', 'Quản lý thành viên')->exists()) {
            DB::table('permission_clubs')->insert([
                'name' => 'Quản lý thành viên',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('permission_clubs')->where('name', 'Quản lý trang CLB')->exists()) {
            DB::table('permission_clubs')->insert([
                'name' => 'Quản lý trang CLB',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('permission_clubs')->where('name', 'Truy cập trang quản lý')->exists()) {
            DB::table('permission_clubs')->insert([
                'name' => 'Truy cập trang quản lý',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('permission_clubs')->where('name', 'Tuyển thành viên')->exists()) {
            DB::table('permission_clubs')->insert([
                'name' => 'Tuyển thành viên',
                'created_at' => now(),
            ]);
        }

        if (!DB::table('permission_clubs')->where('name', 'Quản lý bài viết')->exists()) {
            DB::table('permission_clubs')->insert([
                'name' => 'Quản lý bài viết',
                'created_at' => now(),
            ]);
        }

        if (!DB::table('permission_clubs')->where('name', 'Tạo bài viết mới')->exists()) {
            DB::table('permission_clubs')->insert([
                'name' => 'Tạo bài viết mới',
                'created_at' => now(),
            ]);
        }
    }
}
