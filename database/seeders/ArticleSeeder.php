<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::connection('mongodb')->table('categories')->get();
        $levels = DB::connection('mongodb')->table('article_levels')->get();

        $categoryIds = $categories->pluck('_id')->map(fn($id) => (string) $id)->toArray();
        $levelIds = $levels->pluck('_id')->map(fn($id) => (string) $id)->toArray();


        $authors = [
            'Budi Santoso',
            'Siti Nurhaliza',
            'Ahmad Wijaya',
            'Diana Putri',
            'Eko Prasetyo',
            'Fitri Handayani',
            'Gunawan Sutrisno',
            'Hesti Wulandari',
            'Indra Kusuma',
            'Julia Rahman'
        ];

        $articles = [
            [
                'title' => 'Pengenalan Artificial Intelligence untuk Pemula',
                'slug' => 'pengenalan-artificial-intelligence-untuk-pemula',
                'content' => 'Artificial Intelligence (AI) adalah teknologi yang semakin memengaruhi kehidupan kita sehari-hari. Dalam artikel ini, kita akan membahas konsep dasar AI, jenis-jenis AI, dan bagaimana AI dapat diterapkan dalam berbagai industri. AI terdiri dari Machine Learning, Deep Learning, dan Natural Language Processing yang bekerja bersama untuk menciptakan sistem cerdas.',
                'author' => $authors[0],
                'published_at' => now()->subDays(5),
                'status' => 'published',
                'category_id' => $categoryIds[0], // Technology
                'level_id' => $levelIds[0], // Beginner
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Strategi Digital Marketing untuk UMKM',
                'slug' => 'strategi-digital-marketing-untuk-umkm',
                'content' => 'Digital marketing menjadi kunci kesuksesan UMKM di era modern. Artikel ini membahas strategi efektif untuk meningkatkan brand awareness, lead generation, dan conversion rate melalui berbagai channel digital seperti social media, email marketing, SEO, dan paid advertising.',
                'author' => $authors[1],
                'published_at' => now()->subDays(3),
                'status' => 'published',
                'category_id' => $categoryIds[1], // Business
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'Menggunakan Laravel untuk Enterprise Applications',
                'slug' => 'menggunakan-laravel-untuk-enterprise-applications',
                'content' => 'Laravel adalah framework PHP yang powerful untuk mengembangkan aplikasi enterprise. Artikel ini membahas best practices, architectural patterns, dan scalability considerations ketika menggunakan Laravel untuk proyek-proyek besar dengan kompleksitas tinggi.',
                'author' => $authors[2],
                'published_at' => now()->subDays(7),
                'status' => 'published',
                'category_id' => $categoryIds[2], // Programming
                'level_id' => $levelIds[2], // Advanced
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(7),
            ],
            [
                'title' => 'Prinsip User Experience Design yang Efektif',
                'slug' => 'prinsip-user-experience-design-yang-efektif',
                'content' => 'UX design adalah faktor krusial dalam kesuksesan produk digital. Artikel ini mengupas tuntas prinsip-prinsip UX design yang harus diterapkan, mulai dari user research, information architecture, interaction design, hingga usability testing yang komprehensif.',
                'author' => $authors[3],
                'published_at' => now()->subDays(2),
                'status' => 'published',
                'category_id' => $categoryIds[3], // Design
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(2),
            ],
            [
                'title' => 'Machine Learning dengan Python: Hands-on Tutorial',
                'slug' => 'machine-learning-dengan-python-hands-on-tutorial',
                'content' => 'Python adalah bahasa pemrograman paling populer untuk machine learning. Tutorial ini memberikan panduan praktis implementasi algoritma ML seperti regression, classification, clustering, dan deep learning menggunakan libraries seperti TensorFlow, PyTorch, dan Scikit-learn.',
                'author' => $authors[4],
                'published_at' => now()->subDays(1),
                'status' => 'published',
                'category_id' => $categoryIds[4], // Data Science
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            [
                'title' => 'Cloud Computing: AWS vs Azure vs Google Cloud',
                'slug' => 'cloud-computing-aws-vs-azure-vs-google-cloud',
                'content' => 'Pemilihan cloud provider adalah keputusan strategis untuk bisnis. Artikel ini membandingkan tiga platform cloud terkemuka dari segi fitur, pricing, performance, dan ecosystem untuk membantu Anda membuat keputusan yang tepat.',
                'author' => $authors[5],
                'published_at' => now()->subDays(4),
                'status' => 'published',
                'category_id' => $categoryIds[0], // Technology
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(9),
                'updated_at' => now()->subDays(4),
            ],
            [
                'title' => 'Agile Methodology dalam Software Development',
                'slug' => 'agile-methodology-dalam-software-development',
                'content' => 'Agile methodology telah mengubah cara kita mengembangkan software. Artikel ini membahas framework Scrum, Kanban, dan SAFe, serta bagaimana implementasinya dalam tim development untuk meningkatkan produktivitas dan kualitas produk.',
                'author' => $authors[6],
                'published_at' => now()->subDays(6),
                'status' => 'published',
                'category_id' => $categoryIds[1], // Business
                'level_id' => $levelIds[0], // Beginner
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(6),
            ],
            [
                'title' => 'React vs Vue vs Angular: Komparasi Framework Frontend',
                'slug' => 'react-vs-vue-vs-angular-komparasi-framework-frontend',
                'content' => 'Pemilihan framework frontend memengaruhi produktivitas dan maintainability. Artikel ini membandingkan React, Vue, dan Angular dari berbagai aspek: learning curve, performance, ecosystem, dan use cases yang tepat untuk setiap framework.',
                'author' => $authors[7],
                'published_at' => now()->subDays(8),
                'status' => 'published',
                'category_id' => $categoryIds[2], // Programming
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(8),
            ],
            [
                'title' => 'Color Theory untuk Desainer Grafis',
                'slug' => 'color-theory-untuk-desainer-grafis',
                'content' => 'Pemahaman color theory adalah fundamental untuk desainer grafis. Artikel ini membahas harmoni warna, psikologi warna, dan aplikasi praktis dalam branding, UI design, dan marketing materials untuk menciptakan visual yang impactfull.',
                'author' => $authors[8],
                'published_at' => now()->subDays(9),
                'status' => 'published',
                'category_id' => $categoryIds[3], // Design
                'level_id' => $levelIds[0], // Beginner
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(9),
            ],
            [
                'title' => 'Big Data Analytics untuk Business Intelligence',
                'slug' => 'big-data-analytics-untuk-business-intelligence',
                'content' => 'Big Data analytics mengubah cara bisnis membuat keputusan. Artikel ini eksplorasi tools seperti Hadoop, Spark, dan Tableau untuk processing dan visualisasi data skala besar yang menghasilkan actionable insights.',
                'author' => $authors[9],
                'published_at' => now()->subDays(10),
                'status' => 'published',
                'category_id' => $categoryIds[4], // Data Science
                'level_id' => $levelIds[2], // Advanced
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(10),
            ],
            [
                'title' => 'Cybersecurity Best Practices untuk Perusahaan',
                'slug' => 'cybersecurity-best-practices-untuk-perusahaan',
                'content' => 'Security menjadi prioritas utama di era digital. Artikel ini membahas framework cybersecurity, threat detection, incident response, dan best practices untuk melindungi aset digital dari berbagai jenis serangan cyber.',
                'author' => $authors[0],
                'published_at' => now()->subDays(11),
                'status' => 'published',
                'category_id' => $categoryIds[0], // Technology
                'level_id' => $levelIds[2], // Advanced
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(11),
            ],
            [
                'title' => 'Building Scalable Microservices Architecture',
                'slug' => 'building-scalable-microservices-architecture',
                'content' => 'Microservices architecture adalah solusi untuk aplikasi skala besar. Artikel ini membahas design patterns, communication protocols, service discovery, dan strategies untuk monitoring dan debugging distributed systems.',
                'author' => $authors[1],
                'published_at' => now()->subDays(12),
                'status' => 'published',
                'category_id' => $categoryIds[2], // Programming
                'level_id' => $levelIds[3], // Expert
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(12),
            ],
            [
                'title' => 'Product Management Framework untuk Startups',
                'slug' => 'product-management-framework-untuk-startups',
                'content' => 'Product management adalah kunci kesuksesan startup. Artikel ini membahas frameworks seperti RICE, MoSCoW, dan Jobs-to-be-Done untuk prioritization, product discovery, dan go-to-market strategies.',
                'author' => $authors[2],
                'published_at' => now()->subDays(13),
                'status' => 'published',
                'category_id' => $categoryIds[1], // Business
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(13),
            ],
            [
                'title' => 'Mobile App Design Trends 2024',
                'slug' => 'mobile-app-design-trends-2024',
                'content' => 'Design trends terus berkembang di mobile app industry. Artikel ini mengupas trends terbaru seperti neumorphism, dark mode optimization, gesture-based interactions, dan adaptive design untuk berbagai device.',
                'author' => $authors[3],
                'published_at' => now()->subDays(14),
                'status' => 'published',
                'category_id' => $categoryIds[3], // Design
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(19),
                'updated_at' => now()->subDays(14),
            ],
            [
                'title' => 'Deep Learning untuk Computer Vision',
                'slug' => 'deep-learning-untuk-computer-vision',
                'content' => 'Computer vision adalah aplikasi ML yang revolutioner. Artikel ini membahas CNN architectures, object detection, image segmentation, dan real-world applications dalam autonomous vehicles, medical imaging, dan facial recognition.',
                'author' => $authors[4],
                'published_at' => now()->subDays(15),
                'status' => 'published',
                'category_id' => $categoryIds[4], // Data Science
                'level_id' => $levelIds[3], // Expert
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(15),
            ],
            [
                'title' => 'Blockchain Technology untuk Supply Chain',
                'slug' => 'blockchain-technology-untuk-supply-chain',
                'content' => 'Blockchain mengubah landscape supply chain management. Artikel ini membahas smart contracts, distributed ledger technology, dan implementasi blockchain untuk transparency, traceability, dan efficiency dalam supply chain operations.',
                'author' => $authors[5],
                'published_at' => now()->subDays(16),
                'status' => 'published',
                'category_id' => $categoryIds[0], // Technology
                'level_id' => $levelIds[2], // Advanced
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(16),
            ],
            [
                'title' => 'DevOps Culture dan CI/CD Implementation',
                'slug' => 'devops-culture-dan-cicd-implementation',
                'content' => 'DevOps culture transform cara software development dan operations bekerja. Artikel ini membahas tools seperti Jenkins, GitLab CI, Docker, dan Kubernetes untuk implementasi CI/CD pipeline yang efficient.',
                'author' => $authors[6],
                'published_at' => now()->subDays(17),
                'status' => 'published',
                'category_id' => $categoryIds[2], // Programming
                'level_id' => $levelIds[2], // Advanced
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(17),
            ],
            [
                'title' => 'Financial Planning untuk Young Professionals',
                'slug' => 'financial-planning-untuk-young-professionals',
                'content' => 'Financial literacy penting untuk young professionals. Artikel ini membahas budgeting strategies, investment options, tax planning, dan retirement planning untuk membangun wealth yang sustainable di usia muda.',
                'author' => $authors[7],
                'published_at' => now()->subDays(18),
                'status' => 'published',
                'category_id' => $categoryIds[1], // Business
                'level_id' => $levelIds[0], // Beginner
                'created_at' => now()->subDays(23),
                'updated_at' => now()->subDays(18),
            ],
            [
                'title' => 'Typography Principles untuk Digital Design',
                'slug' => 'typography-principles-untuk-digital-design',
                'content' => 'Typography adalah fondasi visual communication. Artikel ini membahas font selection, hierarchy, readability, dan responsive typography untuk web dan mobile applications yang user-friendly.',
                'author' => $authors[8],
                'published_at' => now()->subDays(19),
                'status' => 'published',
                'category_id' => $categoryIds[3], // Design
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(24),
                'updated_at' => now()->subDays(19),
            ],
            [
                'title' => 'Natural Language Processing dengan Transformers',
                'slug' => 'natural-language-processing-dengan-transformers',
                'content' => 'Transformer architecture revolutioner NLP. Artikel ini membahas BERT, GPT, T5 models dan implementasi untuk text classification, sentiment analysis, machine translation, dan text generation tasks.',
                'author' => $authors[9],
                'published_at' => now()->subDays(20),
                'status' => 'published',
                'category_id' => $categoryIds[4], // Data Science
                'level_id' => $levelIds[3], // Expert
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(20),
            ],
            [
                'title' => 'Quantum Computing: Future of Computing',
                'slug' => 'quantum-computing-future-of-computing',
                'content' => 'Quantum computing adalah next frontier dalam teknologi komputasi. Artikel ini membahas quantum principles, qubits, quantum algorithms, dan potensi aplikasi dalam cryptography, drug discovery, dan optimization problems.',
                'author' => $authors[0],
                'published_at' => now()->subDays(21),
                'status' => 'published',
                'category_id' => $categoryIds[0], // Technology
                'level_id' => $levelIds[3], // Expert
                'created_at' => now()->subDays(26),
                'updated_at' => now()->subDays(21),
            ],
            [
                'title' => 'API Design Best Practices',
                'slug' => 'api-design-best-practices',
                'content' => 'RESTful API design adalah critical skill untuk backend developers. Artikel ini membahas HTTP methods, status codes, authentication, versioning, dan documentation best practices untuk scalable APIs.',
                'author' => $authors[1],
                'published_at' => now()->subDays(22),
                'status' => 'published',
                'category_id' => $categoryIds[2], // Programming
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(27),
                'updated_at' => now()->subDays(22),
            ],
            [
                'title' => 'Growth Hacking Strategies untuk Startups',
                'slug' => 'growth-hacking-strategies-untuk-startups',
                'content' => 'Growth hacking combines marketing, data, and technology. Artikel ini membahas AARRR framework, viral marketing, conversion optimization, dan growth metrics untuk rapid business scaling.',
                'author' => $authors[2],
                'published_at' => now()->subDays(23),
                'status' => 'published',
                'category_id' => $categoryIds[1], // Business
                'level_id' => $levelIds[1], // Intermediate
                'created_at' => now()->subDays(28),
                'updated_at' => now()->subDays(23),
            ],
            [
                'title' => 'Motion Design untuk User Interfaces',
                'slug' => 'motion-design-untuk-user-interfaces',
                'content' => 'Motion design enhances user experience significantly. Artikel ini membahas animation principles, micro-interactions, loading states, dan tools seperti Framer, After Effects untuk creating delightful UI animations.',
                'author' => $authors[3],
                'published_at' => now()->subDays(24),
                'status' => 'published',
                'category_id' => $categoryIds[3], // Design
                'level_id' => $levelIds[2], // Advanced
                'created_at' => now()->subDays(29),
                'updated_at' => now()->subDays(24),
            ],
            [
                'title' => 'Edge Computing: Distributed Intelligence',
                'slug' => 'edge-computing-distributed-intelligence',
                'content' => 'Edge computing brings computation closer to data source. Artikel ini membahas edge devices, fog computing, 5G integration, dan use cases dalam IoT, autonomous vehicles, dan real-time analytics.',
                'author' => $authors[4],
                'published_at' => now()->subDays(25),
                'status' => 'published',
                'category_id' => $categoryIds[0], // Technology
                'level_id' => $levelIds[2], // Advanced
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(25),
            ],
        ];

        // Generate unique id_artikel for each article
        foreach ($articles as &$article) {
            $article['id_artikel'] = 'ART-' . time() . '-' . Str::random(6);
        }

        Article::insert($articles);

        $this->command->info('✅ 25 articles created successfully!');
    }
}
