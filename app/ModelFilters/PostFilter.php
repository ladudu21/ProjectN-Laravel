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

    public function category($category_id)
    {
        if ($category_id){
            return $this->where('category_id', $category_id);
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
}
