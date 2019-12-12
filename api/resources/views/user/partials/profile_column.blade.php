<div class="row">
    <div class="col">
        <p class="profile-label">
            {{ $label }}
        </p>
    </div>
    <div class="col ">
        <p @if(empty($slot->__toString())) class="profile-unfilled-field"@endif>
            @if(empty($slot->__toString()))
                    (Not filled)
            @else
            {{$slot}}
            @endif
        </p>
    </div>
</div>
