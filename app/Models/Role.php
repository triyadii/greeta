<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'namaRole',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
