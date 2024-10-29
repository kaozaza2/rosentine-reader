<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function comics(): BelongsToMany
    {
        return $this->belongsToMany(Comic::class, 'comic_category', 'category_id', 'comic_id');
    }
}
