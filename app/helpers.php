<?php

use App\Models\Permission;
use App\Models\PermissionLevel;
use App\Models\User;

if (! function_exists('has_permission')) {
    function has_permission(User|Permission $perm, PermissionLevel|int $level): bool
    {
        if ($perm instanceof User) {
            $perm = $perm->permission;
        }

        return $perm >= $level;
    }
}
