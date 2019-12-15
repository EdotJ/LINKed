<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagJoint extends Model
{
    protected $table = 'learning_material_tag';
    protected $primaryKey = 'row_id';
    /* Fillable */
    protected $fillable = [
        'learning_material_id', 'tag_id'
    ];

    public function scopeMaterialId($query, $mat_id)
    {
        if ($mat_id) {
            return $query->where("learning_material_id", "LIKE", "%$mat_id%");
        } else{
          return $query;  
        } 
    }
}
