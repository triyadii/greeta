<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalArea extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'namaWilayah',
        'keterangan',
    ];
}
