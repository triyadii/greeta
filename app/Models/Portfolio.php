<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'namaProject',
        'keterangan',
        'gambar',
    ];

    protected function casts(): array
    {
        return [
            'gambar' => 'array',
        ];
    }
}
