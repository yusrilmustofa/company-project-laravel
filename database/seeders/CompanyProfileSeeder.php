<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::create([
            'company_name' => 'Gamatecha Solusi Nusantara',
            'description' => 'Perusahaan teknologi terkemuka di Indonesia yang fokus pada pengembangan solusi digital.',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'phone' => '021-12345678',
            'email' => 'info@gamatech.co.id',
            'logo' => 'logo.png',
            'vision' => 'Menjadi perusahaan teknologi terdepan di Asia Tenggara',
            'mission' => 'Memberikan solusi digital inovatif untuk meningkatkan produktivitas bisnis',
            'social_media' => [
                'facebook' => 'https://facebook.com/gamatech',  
                'instagram' => 'https://instagram.com/gamatech',
                'twitter' => 'https://twitter.com/gamatech',
                'linkedin' => 'https://linkedin.com/company/gamatech',
            ],
        ]);
    }
}