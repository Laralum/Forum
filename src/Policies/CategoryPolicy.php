<?php

namespace Laralum\Forum\Policies;

use Laralum\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laralum\Forum\Models\Category;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Filters the authoritzation.
     *
     * @param mixed $user
     * @param mixed $ability
     */
    public function before($user, $ability)
    {
        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }
    }

    /**
     * Determine if the current user can access categories.
     *
     * @param  mixed $user
     * @return bool
     */
    public function access($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::forum.categories.access');
    }


    /**
     * Determine if the current user can create categories.
     *
     * @param  mixed  $user
     * @return bool
     */
    public function create($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::forum.categories.create');
    }

    /**
     * Determine if the current user can view categories.
     *
     * @param  mixed $user
     * @return bool
     */
    public function view($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::forum.categories.view');
    }

    /**
     * Determine if the current user can update categories.
     *
     * @param  mixed $user
     * @return bool
     */
    public function update($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::forum.categories.update');
    }


    /**
     * Determine if the current user can delete categories.
     *
     * @param  mixed $user
     * @return bool
     */
    public function delete($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::forum.categories.delete');
    }
}
