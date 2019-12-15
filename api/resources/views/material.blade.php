@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Learning material</h2>
            @if (session('success'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{session('success')}}
                </div>
            @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="li">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                            <a class="nav-link" href="#material-personal" data-toggle="tab" role="tab" >My files</a>
                        </li>
                        @if (Auth::user()->role_id == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="#material-delete" data-toggle="tab" role="tab" >Manage</a>
                            </li>
                        @endif
                    </ul> 
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="card-body tab-pane fade show active" id="material-download"  role="tabpanel">
                        <form action="{{ route('materialfilter') }}" method="get">
                            {{ csrf_field() }}
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
                        <table class="col-md-12 learning-material table">
                            <tr>
                                <th class="le-mat1">File title</th>
                                <th class="le-mat2">Uploaded by</th>
                                <th class="le-mat3">Size</th>
                                <th class="le-mat4">Tags</th>
                                <th class="le-mat5">Last update</th>
                                <th class="le-mat6"></th>
                            </tr>
                            @foreach ($materials as $material)
                                @if ($material->private == 0 || Auth::user()->id == $material->user_id )
                                <tr class="material-table-hover">
                                    <td>{{ $material->title }}</td>
                                    <td>{{ Auth::user()->find($material->user_id)->name  }}</td>
                                    <td>{{ round($material->size/1000,2) }} KB</td>
                                    <td>
                                        @foreach ($tags as $tag)
                                            @if ($tag->id == $material->id)
                                                {{$tag->name}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $material->updated_at }}</td>
                                    <form action="{{ route('downloadmaterial', $material->id) }}"  method="post">
                                        {{ csrf_field() }}
                                        <td class="le-mat6" ><input type="submit" class="btn btn-outline-primary" value="Download"></td>
                                    </form>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="card-body tab-pane fade"  id="material-upload"  role="tabpanel"  aria-labelledby="material-upload">
                        <form action="{{ route('uploadmaterial') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <table class="col-md-12 learning-material">
                                <tr>
                                    <td class="le-mat-c1">Title:</td> 
                                    <td class="le-mat-c2"><input type="text" name="title" id="le-mat-text" required></td>
                                </tr>
                                <tr>
                                    <td class="le-mat-c1">Attachment:</td>
                                    <td class="le-mat-c2"><input type="file" name="file" id="le-mat-file" required></td>
                                </tr>
                            </table>
                            <br>
                            <button class="btn btn-outline-primary">Upload</button>
                        </form>
                    </div>
                    <div class="card-body tab-pane fade"  id="material-personal"  role="tabpanel"  aria-labelledby="material-delete">
                        <table class="col-md-12 learning-material table">
                            <tr>
                                <th class="le-mat1">File title</th>
                                <th class="le-mat8">Size</th>
                                <th class="le-mat8">Private</th>
                                <th class="le-mat4">Tags</th>
                                <th class="le-mat5">Last update</th>
                                <th class="le-mat7"></th>
                                <th class="le-mat7"></th>
                            </tr>
                            @foreach ($materials as $material)
                            @if ( Auth::user()->id == $material->user_id)
                            <tr class="material-table-hover">
                                <td>{{ $material->title }}</td>
                                <td>{{ round($material->size/1000,2) }} KB</td>
                                <td>{{ ($material->private==1?"Yes":"No") }}</td>
                                <td>
                                    @foreach ($tags as $tag)
                                        @if ($tag->id == $material->id)
                                            {{$tag->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $material->updated_at }}</td>
                                <td class="le-mat7" >
                                <form action="{{ route('editmaterial', $material->id) }}"  method="get">
                                    {{ csrf_field() }}
                                    @method('put')
                                    <input type="submit" class="btn btn-primary" value="Edit">
                                </form>
                                </td><td class="le-mat7">
                                <form action="{{ route('deletematerial', $material->id) }}"  method="post">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-outline-danger" value="Delete">
                                </form>
                            </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                    @if (Auth::user()->role_id == 2)
                        <div class="card-body tab-pane fade"  id="material-delete"  role="tabpanel"  aria-labelledby="material-delete">
                            <table class="col-md-12 learning-material table">
                                <tr>
                                    <th class="le-mat1">File title</th>
                                    <th class="le-mat2">Uploaded by</th>
                                    <th class="le-mat3">Size</th>
                                    <th class="le-mat4">Tags</th>
                                    <th class="le-mat5">Last update</th>
                                    <th class="le-mat6"></th>
                                </tr>
                                @foreach ($materials as $material)
                                    <tr class="material-table-hover">
                                        <td>{{ $material->title }}</td>
                                        <td>{{ Auth::user()->find($material->user_id)->name  }}</td>
                                        <td>{{ round($material->size/1000,2) }} KB</td>
                                        <td>
                                            @foreach ($tags as $tag)
                                                @if ($tag->id == $material->id)
                                                    {{$tag->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $material->updated_at }}</td>
                                        <form action="{{ route('deletematerial', $material->id) }}"  method="post">
                                            {{ csrf_field() }}
                                            <td class="le-mat6" ><input type="submit" class="btn btn-outline-danger" value="Delete"></td>
                                        </form>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
