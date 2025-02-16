<?php

namespace App\Models;

use App\Enums\TypeUserEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function staffUsers(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'organization_user' )
            ->where('user_type', 'STAFF');
    }
}
