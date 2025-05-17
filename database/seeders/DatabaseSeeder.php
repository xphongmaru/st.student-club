<?php

namespace Database\Seeders;

//use App\Models\Club;
//use App\Models\User;
//// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Club\PermissionSeeder::class,
            Role\PermissionSeeder::class,
            Role\RoleSeeder::class,
            FacultySeeder::class,
            IconSeeder::class,
        ]);
    }
}
