<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pillar extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'namaPilar',
        'keterangan',
    ];
}
