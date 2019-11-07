<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FilledJobFormUser extends Pivot
{
    protected $table = 'filled_job_form_user';

    protected $fillable = [
        'user_id', 'filled_job_form_id'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->belongsTo(FilledJobForm::class);
    }
}
