<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Church extends Model
{
    /** @use HasFactory<\Database\Factories\ChurchFactory> */
    use HasFactory;

    use SoftDeletes;

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'church_owner_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
