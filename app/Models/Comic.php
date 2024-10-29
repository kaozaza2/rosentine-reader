<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Comic extends Model
{
    protected $fillable = [
        'name',
        'alt_name',
        'slug',
        'description',
        'is_complete',
        'is_mature',
    ];

    protected function casts(): array
    {
        return [
            'description' => AsStringable::class,
            'is_complete' => 'boolean',
            'is_mature'   => 'boolean',
        ];
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'comic_tag', 'comic_id', 'tag_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'comic_category', 'comic_id', 'category_id');
    }
}
