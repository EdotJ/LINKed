<?php

namespace App\Filters;

use App\JobForm;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobFormsFilter extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function form_name($term)
    {
        return $this->builder->where('job_forms.name', 'LIKE', "%$term%");
    }

    public function date_from($term)
    {
        return $this->builder->where('job_forms.updated_at', '>=', $term);
    }

    public function date_to($term)
    {
        return $this->builder->where('job_forms.updated_at', '<=', $term);
    }

    public function creator($term)
    {
        return $this->builder->leftJoin('users','users.id','job_forms.user_id')->where('users.name', 'LIKE', "%$term%");
    }
}
