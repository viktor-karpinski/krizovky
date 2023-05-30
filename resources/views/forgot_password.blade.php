@extends('master')

@section('content')
<form class="auth-form" action="{{ route('forgot_password') }}" method="POST">
    @csrf
    <h2>
        Forgot password
    </h2>
    <div class="input-box">
        <label for="email">
            your profile email
        </label>
        <label class="input">
            &gt;
            <input type="email" placeholder="contact@viktorkarpinski.com" id="email" name="email">
        </label>
        @if ($errors->first('email'))
        <span class="error">
            @error('email') {{$message}} @enderror
        </span>
        @endif
    </div>

    <button type="submit" id="btn">
        send email
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