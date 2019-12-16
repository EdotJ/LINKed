@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Edit your file</h2>
            <div class="card">
                <table class="table">
                    <form method="post" action="{{ route('updatematerial', $material->id) }}">
                    @method('PUT') 
                        {{ csrf_field() }}
                        <tr>
                            <td><label >File title</label></td>
                            <td><input type="text" name="name" value={{ $material->title }} ></td>
                        </tr>
                        <tr>
                            <td><label >Private</label></td>
                            <td><input type="checkbox" name="private" value={{ $material->private==1?1:0 }}></td>
                        </tr>
                        <tr>
                            <td><label >Tags</label></td>
                            <td><textarea rows="4" cols="40" name="tags">{{ $temp }}</textarea></td>
                        </tr>
                        <tr>
                            <td><input class="btn btn-primary" type="submit" value="Išsaugoti"></td>
                            <td></td>
                        </tr>
                    </form> 
                </table> 
            </div>
           
        </div>
    </div>
</div>
@endsection
