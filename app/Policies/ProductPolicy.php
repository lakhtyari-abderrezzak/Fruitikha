<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
   public function modify(User $user, Product $product): bool{
    return $user->id === $product->user_id;
   }
}
