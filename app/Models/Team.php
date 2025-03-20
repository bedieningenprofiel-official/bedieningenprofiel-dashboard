<?php

namespace App\Models;

use App\Traits\IsHashed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    use IsHashed;

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(TeamUser::class)->withPivot('role_id');
    }

    public function getRouteKey(): string
    {
        return $this->connectedSalt('teams')
            ->getRouteKeyForModel();
    }
}
