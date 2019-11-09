<div class="form-group row">
    <label for="{{$slot}}"
           class="col-md-4 col-form-label text-md-right">{{ $title }}</label>

    <div class="col-md-6">
        <input id="{{$slot}}" type="{{$type}}"
               class="form-control @error($slot) is-invalid @enderror"
               name="{{$slot}}"
               value="{{ empty(old($slot->__toString())) ? Auth::user()->$slot : old($slot->__toString())}}"
               autocomplete="{{$slot}}">

        @error($slot)
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
