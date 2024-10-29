<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    protected function casts(): array
    {
        return [
            'level' => PermissionLevel::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function has(PermissionLevel $level): bool
    {
        return $this->level->value >= $level->value;
    }
}
