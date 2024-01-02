<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PostFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function category($category)
    {
        if ($category){
            return $this->WhereHas('category', function (Builder $query) use ($category) {
                $query->where('slug', $category);
            });
        }
    }

    public function title($title)
    {
        if ($title){
            return $this->where('title', $title);
        }
    }

    public function author($author)
    {
        if ($author){
            return $this->WhereHas('user', function (Builder $query) use ($author) {
                $query->where('name', 'like', '%' . $author . '%');
            });
        }
    }

    public function tag($tag)
    {
        if ($tag){
            return $this->WhereHas('tags', function (Builder $query) use ($tag) {
                $query->where('name',  $tag);
            });
        }
    }

    public function setup()
    {
        $this->published();
    }
}
