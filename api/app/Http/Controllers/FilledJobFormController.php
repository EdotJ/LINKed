<?php

namespace App\Http\Controllers;

use App\FilledJobForm;
use App\JobForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilledJobFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('filled-form.index',[
            'forms' => FilledJobForm::with('jobForm')->get(),
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
        if(!$request->has('formId'))
            return redirect()->back()->withErrors('Something went wrong');

        $validators = $this->getValidators($request->input('formId'));
        $attributes = $this->validate($request, $validators);

        FilledJobForm::create($attributes + ['form_id' => $request->input('formId')])
            ->users()->attach(auth()->user()->id);

        return redirect(route('job-forms.index'))->with('success', 'Job form submitted');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param FilledJobForm $filledForm
     * @return \Illuminate\Http\Response
     */
    public function edit(FilledJobForm $filledForm)
    {
        $jobForm = JobForm::find($filledForm->form_id);

        return view('filled-form.edit',[
            'statuses' => DB::table('forms_field_status')->get()->mapWithKeys(function ($value, $key){
                return [$value->id => $value->status];
            }),
            'fields' => collect($jobForm->getAttributes())->except(['created_at','updated_at','user_id','name','id']),
            'jobFormId' => $jobForm->id,
            'filledForm' => $filledForm,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FilledJobForm  $filledJobForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilledJobForm $filledJobForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FilledJobForm $filledForm
     * @return void
     * @throws \Exception
     */
    public function destroy(FilledJobForm $filledForm)
    {
        $filledForm->delete();
        return redirect()->back()->with('success', 'Filled form was deleted');
    }

    public function show(FilledJobForm $filledForm)
    {
        $fields = collect($filledForm->getAttributes())
            ->except(['id', 'form_id'])
            ->filter(function ($value, $key){
                return !is_null($value);
            });

        return view('filled-form.show',[
            'fields' => $fields,
            'form' => $filledForm,
        ]);
    }

    /**
     * Return array of fields that ahs to be validated and their rules
     * @return array
     */
    private function getValidators($form): array
    {
        $jobForm = JobForm::find($form);

        $statuses = DB::table('forms_field_status')->get()->mapWithKeys(function ($value, $key){
            return [$value->id => $value->status];
        });

        $fields = collect($jobForm->getAttributes())->except(['created_at','updated_at','user_id','name','id']);

        $attributes = [];

        foreach ($fields as $field => $status) {
            if($statuses->get($status) === 'unused') continue;
            $attributes[$field]  = $statuses->get($status) === 'required' ? ['required'] : ['sometimes'];
        }

        return $attributes;
    }
}
