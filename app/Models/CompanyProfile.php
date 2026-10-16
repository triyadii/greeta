<?php

namespace App\Models;

use App\Models\Traits\HasCustomUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasCustomUuid, HasFactory;

    protected $fillable = [
        'uuid',
        'namaPerusahaan',
        'logo',
        'alamatPerusahan',
        'nomorTeleponPerusahaan',
        'emailPerusahaan',
        'websitePerusahaan',
        'instagram',
        'tiktok',
        'treads',
        'facebook',
    ];

    protected $appends = [
        'logo_url',
    ];

    public const DEFAULT_LOGO = 'https://lh3.googleusercontent.com/aida/AEtjO1X9E2w3eu5Tp-5nDqWqkfn3Pb3EncTNdUDnPDluLQb7x9o1MEA53AqEBwOwY0ein5ym31YytcUF50c6cIoKcxlYWh0KeZFnS5XBr793pphLUpYCiBWL8hssy0EyIxiiOxgLBmt7BSp5bBcFhvpq3XtPk8Sdm9FYPvfQeuTPCzB80PKGjUoU7X9x3UXcC4Oj813d1vfaHAQufwCfPIkm_BczratuU56bUo_p4tLKo_8a1i-kKGDks6bJSmxF';

    /**
     * Get full logo URL with fallback.
     */
    public function getLogoUrlAttribute(): string
    {
        if (! empty($this->logo)) {
            if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
                return $this->logo;
            }

            return asset('storage/'.$this->logo);
        }

        return self::DEFAULT_LOGO;
    }
}
