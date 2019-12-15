<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class JobForm extends Model
{
    use Filterable;

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
