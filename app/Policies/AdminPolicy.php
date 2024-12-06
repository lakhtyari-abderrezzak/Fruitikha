<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
   public function modify(User $user){
        return $user->status === 'admin';
   }
}
