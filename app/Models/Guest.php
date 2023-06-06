<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guests';

    public $timestamps = false;

    protected $fillable = ['uuid'];

    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeOfTypeUser($query, $type)
    {
        return $query->where('id', $type)->value('uuid');
    }

    public function scopeRoleId($query)
    {
        return $query->where('role_id', Role::ID_GUEST);
    }
}
