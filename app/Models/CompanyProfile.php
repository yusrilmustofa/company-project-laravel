<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'company_profiles';

    protected $fillable = [
        'company_name',
        'description',
        'address',
        'phone',
        'email',
        'logo',
        'vision',
        'mission',
        'social_media',
    ];

    protected function casts(): array
    {
        return [
            'social_media' => 'array',
        ];
    }
}