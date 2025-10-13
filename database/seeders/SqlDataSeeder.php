<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqlDataSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('dumps/seed_data.sql');
        if (!file_exists($path)) {
            $this->command?->warn('SQL dump tidak ditemukan: database/dumps/seed_data.sql (dilewati)');
            return;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::unprepared(file_get_contents($path));
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->command?->info('SQL dump berhasil dijalankan.');
    }
}