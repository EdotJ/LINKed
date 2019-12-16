<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Material extends Model
{
    protected $table = 'learning_materials';
    /* Fillable */
    protected $fillable = [
        'title', 'path', 'user_id', 'size', 'private'
    ];
    /* @array $appends */
    public $appends = ['url', 'uploaded_time', 'size_in_kb'];
    
    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->path);
    }
    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getSizeInKbAttribute()
    {
        return round($this->size / 1024, 2);
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($file) {
            $file->user_id = auth()->user()->id;
        });
    }
}
