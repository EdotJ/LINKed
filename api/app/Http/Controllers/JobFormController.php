<?php

namespace App\Http\Controllers;

use App\JobForm;
use PDF;
use App\Filters\JobFormsFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobFormController extends Controller
{
    /**
     * @var \Illuminate\Support\Collection
     */
    private $columns;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->columns =  $this->getTableColumns('job_forms')->reject(function ($column) {
            return in_array($column, ['id','created_at','updated_at', 'name', 'user_id']);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobFormsFilter $filters)
    {
        return view('job-form.index',[
            'forms' => JobForm::filter($filters)->with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job-form.create',[
            'fields' => $this->columns,
            'statuses' => DB::table('forms_field_status')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validators = $this->getValidators();
        $attributes = $this->validate($request, $validators);

        JobForm::create($attributes + ['user_id' => auth()->user()->id]);

        return redirect(route('job-forms.index'))->with('success', 'Job form created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobForm  $jobForm
     * @return \Illuminate\Http\Response
     */
    public function show(JobForm $jobForm)
    {
        return view('job-form.show',[
            'statuses' => DB::table('forms_field_status')->get()->mapWithKeys(function ($value, $key){
                return [$value->id => $value->status];
            }),
            'fields' => collect($jobForm->getAttributes())->except(['created_at','updated_at','user_id','name','id']),
            'jobFormId' => $jobForm->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobForm  $jobForm
     * @return \Illuminate\Http\Response
     */
    public function edit(JobForm $jobForm)
    {
        if(!auth()->user()->isJobFormOwner($jobForm->id))
            return redirect()->back()->withErrors('Forbidden');

        return view('job-form.edit',[
            'fields' => $this->columns,
            'statuses' => DB::table('forms_field_status')->get(),
            'jobForm' => $jobForm,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\JobForm $jobForm
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, JobForm $jobForm)
    {
        $validators = $this->getValidators();
        $attributes = $this->validate($request, $validators);

        $jobForm->update($attributes);

        return redirect(route('job-forms.index'))->with('success', 'Job form updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\JobForm $jobForm
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(JobForm $jobForm)
    {
        if(!auth()->user()->isJobFormOwner($jobForm->id))
            return redirect()->back()->withErrors('Forbidden');

        $jobForm->delete();
        return redirect()->back()->with('success', 'Job form was deleted');
    }

    /**
     * Returns job form in pdf format
     *
     * @param \App\JobForm $jobForm
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getPdf(JobForm $jobForm)
    {
        $pdf = PDF::loadView('pdf.job-form',  [
            'jobFormId' => $jobForm->id,
            'fields' => collect($jobForm->getAttributes())->except(['created_at','updated_at','user_id','name','id']),
            'statuses' => DB::table('forms_field_status')->get()->mapWithKeys(function ($value, $key){
                return [$value->id => $value->status];
            }),
        ]);
        return $pdf->download('job-form.pdf');
    }

    /**
     * Return array of fields that has to be validated and their rules
     * @return array
     */
    private function getValidators(): array
    {
        $fields = $this->getTableColumns('job_forms')->reject(function ($column) {
            return in_array($column, ['id','created_at','updated_at', 'name', 'user_id']);
        });

        $attributes = [];

        foreach ($fields as $field) {
            $attributes[$field]  = ['required', 'numeric'];
        }

        $attributes['name'] = ['required', 'string'];

        return $attributes;
    }
}
