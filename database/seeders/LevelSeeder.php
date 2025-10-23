<?php

namespace Database\Seeders;

use App\Models\ArticleLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Beginner',
                'slug' => 'beginner',
                'description' => 'Artikel untuk pemula yang baru memulai belajar tentang topik ini. Konten disajikan dengan bahasa yang mudah dimengerti dan langkah-langkah yang detail.',
                'level_order' => 1,
                'status' => 'active',
                'color' => '#28a745',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Intermediate',
                'slug' => 'intermediate',
                'description' => 'Artikel untuk mereka yang sudah memiliki pemahaman dasar dan ingin meningkatkan kemampuan ke level menengah.',
                'level_order' => 2,
                'status' => 'active',
                'color' => '#ffc107',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Advanced',
                'slug' => 'advanced',
                'description' => 'Artikel tingkat lanjut untuk pembaca yang sudah berpengalaman dan ingin mendalami topik secara teknis.',
                'level_order' => 3,
                'status' => 'active',
                'color' => '#fd7e14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Expert',
                'slug' => 'expert',
                'description' => 'Artikel untuk ahli dan profesional yang ingin mempelajari konsep-konsep paling kompleks dan terkini dalam industri.',
                'level_order' => 4,
                'status' => 'active',
                'color' => '#dc3545',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        ArticleLevel::insert($levels);



        $this->command->info('✅ 4 article levels created successfully!');
    }
}