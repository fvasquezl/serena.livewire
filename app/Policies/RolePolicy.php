<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Role $role)
    {
        return  $user->hasRole('Admin') || $user->hasPermissionTo('View roles');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return  $user->hasRole('Admin') || $user->hasPermissionTo('Create roles');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Role $role)
    {
        return  $user->hasRole('Admin') || $user->hasPermissionTo('Update roles');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $role)
    {
        if ($role->id === 1) {
            throw new AuthorizationException('No se puede eliminar este role');
        }

        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete roles');
    }
}
