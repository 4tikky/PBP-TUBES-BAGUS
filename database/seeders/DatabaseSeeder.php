<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent seeders (default)
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
        ]);

        // Jalankan jika kamu menyediakan dump data lengkap (opsional)
        // $this->call(SqlDataSeeder::class);
    }
}
