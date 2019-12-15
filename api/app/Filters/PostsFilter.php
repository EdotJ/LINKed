<?php

namespace App\Filters;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostsFilter extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function post_name($term)
    {
        return $this->builder->where('posts.name', 'LIKE', "%$term%");
    }

    public function date_from($term)
    {
        return $this->builder->where('posts.updated_at', '>=', $term);
    }

    public function date_to($term)
    {
        return $this->builder->where('posts.updated_at', '<=', $term);
    }
}
