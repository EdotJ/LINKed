<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Filterable;
    protected $table = 'posts';
    protected $fillable = [
        'name', 'content', 'is_job', 'form_id', 'user_id'
    ];

    protected $guarded = [
        'id', 'created_at'
    ];

    protected $casts = [
         'is_job' => 'boolean' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
