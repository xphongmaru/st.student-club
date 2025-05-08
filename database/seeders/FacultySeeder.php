<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!DB::table('faculties')->where('name', 'Khoa Công nghệ thông tin')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Khoa Công nghệ thông tin',
                'created_at' => now(),
            ]);
        }

        if (!DB::table('faculties')->where('name', 'Chăn nuôi')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Chăn nuôi',
                'created_at' => now(),
            ]);
        }

        if (!DB::table('faculties')->where('name', 'Công nghệ thực phẩm')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Công nghệ thực phẩm',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Cơ - Điện')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Cơ - Điện',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Công nghệ sinh học')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Công nghệ sinh học',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Du lịch & Ngoại ngữ')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Du lịch & Ngoại ngữ',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Khoa Kinh tế và quản lý')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Khoa Kinh tế và quản lý',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Kế toán và Quản trị kinh doanh')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Kế toán và Quản trị kinh doanh',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Khoa học xã hội')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Khoa học xã hội',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Nông học')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Nông học',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Tài nguyên và Môi trường')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Tài nguyên và Môi trường',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Thú y')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Thú y',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('faculties')->where('name', 'Thủy sản')->exists()) {
            DB::table('faculties')->insert([
                'name' => 'Thủy sản',
                'created_at' => now(),
            ]);
        }
    }
}
