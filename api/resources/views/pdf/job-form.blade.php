<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Job form</title>
</head>
<body>
        <h1>Job form</h1>
        <hr>
        <div class="container mt-4">
        @include('errors')
        <form action="{{ route('filled-forms.store') }}" method="post">
            @csrf
            @foreach($fields as $field => $status)
                <div style="width: 100%; margin-top: 20px">
                    @if($statuses->get($status) !== 'unused' )
                        <label style="text-transform: capitalize;" for="{{$field}}">{{ implode(" ", explode('_', $field)) }}:</label>
                        <input type="text" style="width: 100%"
                               id="{{$field}}" name="{{$field}}" placeholder="Enter {{ implode(" ", explode('_', $field)) }}"
                               value="{{ old($field) }}"
                        >
                    @endif
                </div>
            @endforeach
        </form>
    </div>
</body> 
</html>
