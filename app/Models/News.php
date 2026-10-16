<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'judul',
        'slug',
        'keterangan',
        'gambar',
    ];

    protected function casts(): array
    {
        return [
            'gambar' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->judul) . '-' . Str::random(5);
            }
        });
    }
}
