<?php

namespace App\Models;

use App\Traits\SetDefaultUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    use HasFactory, SetDefaultUid;

    protected $fillable = [
        'uid',
        'name'
    ];

    /**
     * Define default route key
     *
     * @return null|string
     */
    public function getRouteKeyName(): ?string
    {
        return 'uid';
    }

    /**
     * Return organization companyes
     *
     * @return HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Return organization staff users
     *
     * @return BelongsToMany
     */
    public function staffUsers(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'organization_user' )
            ->where('user_type', 'STAFF');
    }
}
