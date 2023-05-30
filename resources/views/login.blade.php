@extends('master')

@section('content')
<form class="auth-form" action="{{ route('login') }}" method="POST">
    @csrf
    <h2>
        Login
    </h2>
    <a href="{{ route('view_signup') }}">
        No profile? Click <span class="highlight">here!</span>
    </a>
    <div class="input-box">
        <label for="name">
            username
        </label>
        <label class="input">
            &gt;
            <input type="text" placeholder="viktoro" id="name" name="name">
        </label>
        @if ($errors->first('name'))
        <span class="error">
            @error('name') {{$message}} @enderror
        </span>
        @endif
    </div>
    <div class="input-box">
        <label for="password">
            password
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

    <label class="check-box" for="stay">
        <div class="check">
            <img src="{{ asset('images/checkmark.png') }}" alt="checkmark">
        </div>
        stay logged in
        <input type="checkbox" name="remember" id="stay">
    </label>

    <button type="submit" id="btn">
        login
    </button>

    <a href="{{ route('view_forgot_password') }}">
       Forgot your password? Reset <span class="highlight">here!</span>
    </a>
</form>

<script>
    window.onload = () => {
        hrColor('.input', true)
        hrColor('#btn', false)
        hrColor('.check', true)
        $('.highlight').css('color', getColor())
    }

    $('#stay').on('change', (ev) => {
        $('.check').toggleClass('checked')
        if (ev.target.checked) {
            hrColor('.check', false)
        } else {
            $('.check').attr('style', '')
            hrColor('.check', true)
        }
    })
    
</script>
@endsection