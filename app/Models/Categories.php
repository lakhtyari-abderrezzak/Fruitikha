<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'img_path',
    ];
    public function products(): HasMany  
    {
        return $this->hasMany(Product::class, 'categories_id');
    }
}
