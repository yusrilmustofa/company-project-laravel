<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

class ArticleLevel extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'article_levels';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'level_order',
        'status', // active, inactive
        'color', // Warna untuk UI (opsional)
    ];

    protected $casts = [
        'level_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($level) {
            if (empty($level->slug)) {
                $level->slug = Str::slug($level->name);
            }

            // Auto generate level_order jika tidak diisi
            if (empty($level->level_order)) {
                $lastLevel = static::where('status', 'active')->orderBy('level_order', 'desc')->first();
                $level->level_order = $lastLevel ? $lastLevel->level_order + 1 : 1;
            }
        });

        static::updating(function ($level) {
            // Update slug jika name berubah
            if ($level->isDirty('name') && empty($level->slug)) {
                $level->slug = Str::slug($level->name);
            }
        });
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'level_id');
    }

    // Scope untuk mengambil level yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope untuk mengambil level berdasarkan urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('level_order', 'asc');
    }
}