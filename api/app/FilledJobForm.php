<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilledJobForm extends Model
{
    protected $table = 'filled_job_forms';

    protected $guarded = ['id'];

    public function jobForm()
    {
        return $this->belongsTo(JobForm::class, 'form_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'filled_job_form_user','filled_job_form_id', 'user_id');
    }

}
