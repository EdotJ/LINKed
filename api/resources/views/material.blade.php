@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#material-download" data-toggle="tab" role="tab" >Download</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#material-upload" data-toggle="tab" role="tab" >Upload</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#material-delete" data-toggle="tab" role="tab" >Delete</a>
                        </li>
                    </ul> 
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="card-body tab-pane fade show active" id="material-download"  role="tabpanel">
                        <form action="get">
                            <table class="">
                                <tr>
                                    <td class="le-mat-t1">
                                        <input class="le-mat-full" type="text"  name="tags" id="" placeholder="enter your tags, e.g. calculus art music">
                                    </td>
                                    <td class="le-mat-t2">
                                        <button class="btn btn-primary le-mat-full" type="submit">Filter</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <table class="col-md-12 learning-material">
                            <tr>
                                <th class="le-mat1">File name</th>
                                <th class="le-mat2">Uploaded by</th>
                                <th class="le-mat3">Tags</th>
                                <th class="le-mat4">Last update</th>
                                <th class="le-mat5"></th>
                            </tr>
                        @foreach ($materials as $material)
                            <tr>
                                <td>{{ $material->name }}</td>
                                <td>{{ $material->user_id }}</td>
                                <td>{{ $material->updated_at }}</td>
                                <td></td>
                                <td class="le-mat5" ><button class="btn btn-outline-primary">Download</button></td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                    <div class="card-body tab-pane fade"  id="material-upload"  role="tabpanel"  aria-labelledby="material-upload">
                        <form action="post">
                            <table class="col-md-12 learning-material">
                                <tr>
                                    <td class="le-mat-c1">Attachment:</td>
                                    <td class="le-mat-c2"><input type="file" name="file" id="le-mat-file"></td>
                                </tr>
                                <tr>
                                    <td class="le-mat-c1">Tags:</td> 
                                    <td class="le-mat-c2"><input type="text" name="text" id="le-mat-text"></td>
                                </tr>
                            </table>
                            <br>
                            <button class="btn btn-outline-primary">Upload</button>
                        </form>
                    </div>
                    <div class="card-body tab-pane fade"  id="material-delete"  role="tabpanel"  aria-labelledby="material-delete">
                        <table class="col-md-12 learning-material">
                            <tr>
                                <th class="le-mat1">File name</th>
                                <th class="le-mat3">Tags</th>
                                <th class="le-mat4">Last update</th>
                                <th class="le-mat5"></th>
                            </tr>
                        @foreach ($materials as $material)
                            <tr>
                                <td>{{ $material->name }}</td>
                                <td>{{ $material->updated_at }}</td>
                                <td></td>
                                <td class="le-mat5" ><button class="btn btn-outline-danger">Delete</button></td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
