<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobForm extends Model
{
    protected $table = 'job_forms';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function filledForm()
    {
        return $this->hasMany(FilledJobForm::class);
    }
}
