@extends('master')

@section('content')
<form class="auth-form" action="{{ route('save') }}" method="POST">
    @csrf
    <h2>
        Save your level
    </h2>
    <div class="input-box">
        <label for="name">
            choose a name for your level
        </label>
        <label class="input">
            &gt;
            <input type="text" placeholder="#funny-circle" id="name" name="name" value="{{ old('name') }}">
        </label>
        @if ($errors->first('name'))
        <span class="error">
            @error('name') {{$message}} @enderror
        </span>
        @endif
    </div>

    <input type="hidden" id="save" name="save">
    <input type="hidden" id="size" name="size">
    <input type="hidden" id="percentage" name="percentage">

    <button type="submit" id="btn">
        save
    </button>
</form>

<script>
    window.onload = () => {
        hrColor('.input', true)
        hrColor('#btn', false)

        $('#save').val(window.localStorage.getItem('save'))
        $('#size').val(window.localStorage.getItem('size'))
        $('#percentage').val(window.localStorage.getItem('percentage'))
    }

    
</script>
@endsection