<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'name', 'content', 'is_job'
    ];

    protected $guarded = [
        'id', 'created_at'
    ];

    protected $casts = [
         'is_job' => 'boolean' 
    ];
}
