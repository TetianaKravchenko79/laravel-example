<?php

namespace App\Policies;

use App\Models\ {User, Cart};

class CartPolicy extends Policy
{
    /**
     * Determine whether the user can manage the comment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Cart $cart
     * @return mixed
     */
    public function manage(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }
}
