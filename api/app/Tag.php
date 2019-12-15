<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'name'
    ];

    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where("name", "LIKE", "%$name%");
        } else{
          return $query;  
        } 
    }
}
