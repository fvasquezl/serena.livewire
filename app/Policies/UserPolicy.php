<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function before(User $user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $authUser
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $authUser, User $user)
    {
        return $authUser->id === $user->id
            || $user->hasPermissionTo('View users');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $authUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Create users');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $authUser
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $authUser, User $user)
    {
        return $authUser->id === $user->id
            || $user->hasPermissionTo('Update users');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $authUser
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $authUser, User $user)
    {
        return $authUser->id === $user->id
            || $user->hasPermissionTo('Delete users');
    }
}
