@extends('master')

@section('content')
<form class="auth-form" action="{{ route('forgot_password') }}" method="POST">
    @csrf
    <h2>
        Reset password
    </h2>
    <div class="input-box">
        <label for="password">
            choose new password
        </label>
        <label class="input">
            &gt;
            <input type="password" placeholder="#strongestPassword69" id="password" name="password">
        </label>
        @if ($errors->first('password'))
        <span class="error">
            @error('password') {{$message}} @enderror
        </span>
        @endif
    </div>

    <div class="input-box">
        <label for="confirm_password">
            confirm password
        </label>
        <label class="input">
            &gt;
            <input type="password" placeholder="#strongestPassword69" id="confirm_password" name="confirm_password">
        </label>
        @if ($errors->first('confirm_password'))
        <span class="error">
            @error('confirm_password') {{$message}} @enderror
        </span>
        @endif
    </div>

    <button type="submit" id="btn">
        save password
    </button>
</form>

<script>
    window.onload = () => {
        hrColor('.input', true)
        hrColor('#btn', false)
        $('.highlight').css('color', getColor())
    }
</script>
@endsection