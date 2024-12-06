<?php

namespace App\Policies;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoriesPolicy
{
   public function modify(User $user){
        return $user->status === 'admin';
   }
}
