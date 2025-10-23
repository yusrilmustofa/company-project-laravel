<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');

        // Run seeders in order to maintain foreign key relationships
        $this->call([
            LevelSeeder::class,        // 1. Levels (no dependencies)
            UserSeeder::class,         // 2. Users (no dependencies)
            CategorySeeder::class,     // 3. Categories (no dependencies)
            ArticleSeeder::class,      // 4. Articles (depends on categories & levels)
            CompanyProfileSeeder::class, // 5. Existing seeder
        ]);

        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('📊 Summary:');
        $this->command->info('   - 4 Article Levels');
        $this->command->info('   - 10 Users (Penulis)');
        $this->command->info('   - 5 Categories');
        $this->command->info('   - 25 Articles');
    }
}