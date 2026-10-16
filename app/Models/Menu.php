<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'namaMenu',
        'url',
        'icon',
        'akses',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'akses' => 'array',
            'urutan' => 'integer',
        ];
    }
}
