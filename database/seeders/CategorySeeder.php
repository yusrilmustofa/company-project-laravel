<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Artikel tentang perkembangan teknologi terkini, software, hardware, dan inovasi digital yang mengubah dunia.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Wawasan tentang strategi bisnis, entrepreneurship, manajemen, dan tren industri yang memengaruhi pasar global.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'description' => 'Tutorial dan panduan pemrograman, best practices, framework, dan teknik coding untuk developer profesional.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Artikel tentang UI/UX design, grafis, arsitektur, dan prinsip desain yang menciptakan pengalaman pengguna yang luar biasa.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Eksplorasi data science, machine learning, analitik, dan visualisasi data untuk mendapatkan insight yang berharga.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Category::insert($categories);

        $this->command->info('✅ 5 categories created successfully!');
    }
}
