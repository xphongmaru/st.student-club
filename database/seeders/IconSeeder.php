<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!DB::table('icons')->where('name', 'facebook')->exists()) {
            DB::table('icons')->insert([
                'name' => 'facebook',
                'thumbnail' => 'assets\client\images\icons\facebook.png',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('icons')->where('name', 'tiktok')->exists()) {
            DB::table('icons')->insert([
                'name' => 'tiktok',
                'thumbnail' => 'assets\client\images\icons\tiktok.png',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('icons')->where('name', 'link')->exists()) {
            DB::table('icons')->insert([
                'name' => 'link',
                'thumbnail' => 'assets\client\images\icons\link.png',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('icons')->where('name', 'instagram')->exists()) {
            DB::table('icons')->insert([
                'name' => 'instagram',
                'thumbnail' => 'assets\client\images\icons\instagram.png',
                'created_at' => now(),
            ]);
        }
        if (!DB::table('icons')->where('name', 'youtube')->exists()) {
            DB::table('icons')->insert([
                'name' => 'youtube',
                'thumbnail' => 'assets\client\images\icons\youtube.png',
                'created_at' => now(),
            ]);
        }
    }
}
