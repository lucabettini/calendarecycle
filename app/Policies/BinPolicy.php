<?php

namespace App\Policies;

use App\Models\Bin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BinPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view, change or delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bin  $bin
     * @return mixed
     */
    public function change(User $user, Bin $bin)
    {
        return $user->id === $bin->user_id;
    }
}
