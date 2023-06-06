<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    const ID_GUEST = 1;
    const ID_USER = 2;
    const ID_ADMINISTRATOR = 3;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
