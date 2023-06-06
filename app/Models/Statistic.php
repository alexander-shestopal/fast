<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'statistics';

    public $timestamps = false;

    protected $fillable = [ 'role_id', 'user_id', 'type', 'action', 'ip_address', 'created_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public static function getValidationRules(): array
    {
        return [
            'type.*' => 'in:login,logout,register,view_buy,view_download,click_buy,click_download',
            'action.*' => 'in:login,logout,register,view_page,button_click',
            'name' => 'nullable|string',
            'startDate'=> 'nullable|date',
            'endDate' => 'nullable|date'
        ];
    }

    public static function createValidationRules(): array
    {
        return [
            'type' => 'required|in:login,logout,register,view_buy,view_download,click_buy,click_download',
            'action' => 'required|in:login,logout,register,view_page,button_click',
            'user_id' => 'required|integer',
            'role_id' => 'required|integer|exists:roles,id',
            'created_at' => 'required|date'
        ];
    }
}
