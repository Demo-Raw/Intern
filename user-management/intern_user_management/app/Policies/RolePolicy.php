<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\RolePermission;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        $allowedRoleId = RolePermission::select('role_id')
                            ->whereIn('permission_id', [5, 9])
                            ->get()
                            ->pluck('role_id')
                            ->toArray();

        $authRoleId = $user->role_id;

        if (in_array($authRoleId, $allowedRoleId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $allowedRoleId = RolePermission::select('role_id')
                            ->whereIn('permission_id', [6, 9])
                            ->get()
                            ->pluck('role_id')
                            ->toArray();

        $authRoleId = $user->role_id;

        if (in_array($authRoleId, $allowedRoleId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        $allowedRoleId = RolePermission::select('role_id')
                            ->whereIn('permission_id', [7, 9])
                            ->get()
                            ->pluck('role_id')
                            ->toArray();

        $authRoleId = $user->role_id;

        if (in_array($authRoleId, $allowedRoleId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        $allowedRoleId = RolePermission::select('role_id')
                            ->whereIn('permission_id', [8, 9])
                            ->get()
                            ->pluck('role_id')
                            ->toArray();

        $authRoleId = $user->role_id;

        if (in_array($authRoleId, $allowedRoleId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        //
    }
}
