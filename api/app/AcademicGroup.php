<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'name', 'shorthand_code'
    ];

    protected $guarded = [
        'id'
    ];
}
