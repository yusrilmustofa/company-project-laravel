<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'articles';
    
    // Untuk MongoDB, kita tetap menggunakan _id sebagai primary key
    // tapi menambahkan field id_artikel sebagai identifier custom

    protected $fillable = [
        'id_artikel',
        'title',
        'slug',
        'content',
        'image',
        'author',
        'published_at',
        'status', // draft, published
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    // Auto generate id_artikel dan slug dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            // Generate custom ID untuk artikel
            if (empty($article->id_artikel)) {
                $article->id_artikel = 'ART-' . time() . '-' . Str::random(6);
            }
            
            // Auto generate slug dari title
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            // Update slug jika title berubah
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}