<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'content',
        'thumb',
        'published_at',
        'slug',
        'status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relationship
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Local Scope
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopeUnPublished(Builder $query): void
    {
        $query->where('status', 0);
    }

    public function tagList() {
        return $this->tags->pluck('name')->implode(' ');
    }
}
