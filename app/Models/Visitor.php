<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'ip_address',
        'user_agent',
        'visit_date',
        'visit_count',
    ];

    protected function casts(): array
    {
        return [
            'visit_date' => 'date',
            'visit_count' => 'integer',
        ];
    }
}
