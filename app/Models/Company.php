<?php

namespace App\Models;

use App\Traits\SetDefaultUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory, SetDefaultUid;

    protected $fillable = [
        'uid',
        'name',
        'organization_id',
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
     * Return company organization
     *
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Return company clients
     *
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'company_user' )
            ->where('user_type', 'CLIENT');
    }
}
