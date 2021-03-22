<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ProductPolicy
 * @package App\Policies
 */
class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param User|null $user
     * @param Product $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        if ($user === null) return false;

        if (!$product->approved && $user->id != $product->user_id) return false;

        return $user->id == $product->user_id;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('add product');
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return ($user->can('edit own product') && $user->id == $product->user_id) ? true : false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $user->id == $product->user_id;
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        return $user->id == $product->user_id;
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        return $user->id == $product->user_id;
    }

    /**
     * @param User $user
     * @param Image $image
     * @return bool
     */
    public function imageDelete(User $user, Image $image)
    {
        return $user->id == $image->imageable->user_id;
    }

    /**
     * Perform pre-authorization checks.
     *
     * @param \App\Models\User $user
     * @param string $ability
     * @return void|bool
     */
    public function after(User $user, $ability)
    {
        return $user->can('allow all actions');
    }
}
