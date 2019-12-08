<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    // Might be confusing but this resolves name to filter and can be used as Foo::filter()
    // for more info : https://laravel.com/docs/5.8/eloquent#local-scopes
    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }
}
