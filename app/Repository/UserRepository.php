<?php

namespace App\Repository;


use App\Models\User;
use Illuminate\Support\Collection;

/**
 *
 */
class UserRepository
{
    /**
     * @return User
     */
    public function getAllFreeUsers() : Collection{
        return User::where(['active' => 0])->get();
    }
}
