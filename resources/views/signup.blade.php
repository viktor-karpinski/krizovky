@extends('master')

@section('content')
<form class="auth-form" action="{{ route('signup') }}" method="POST">
    @csrf
    <h2>
        Signup
    </h2>
    <a href="{{ route('view_login') }}">
        Already have a profile? Login <span class="highlight">here!</span>
    </a>
    <div class="input-box">
        <label for="name">
            choose username
        </label>
        <label class="input">
            &gt;
            <input type="text" placeholder="viktoro" id="name" name="name" value="{{ old('name') }}">
        </label>
        @if ($errors->first('name'))
        <span class="error">
            @error('name') {{$message}} @enderror
        </span>
        @endif
    </div>
    <div class="input-box">
        <label for="email">
            your email
        </label>
        <label class="input">
            &gt;
            <input type="email" placeholder="contact@viktorkarpinski.com" id="email" name="email"  value="{{ old('email') }}">
        </label>
        @if ($errors->first('email'))
        <span class="error">
            @error('email') {{$message}} @enderror
        </span>
        @endif
    </div>
    <div class="input-box">
        <label for="password">
            choose password
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
    </div>

    <label class="check-box" for="stay">
        <div class="check">
            <img src="{{ asset('images/checkmark.png') }}" alt="checkmark">
        </div>
        I accept the privacy policy
        <input type="checkbox" name="privacy_policy" id="stay">
    </label>
    @if ($errors->first('privacy_policy'))
    <span class="error" style="margin-top: -1rem">
        @error('privacy_policy') {{$message}} @enderror
    </span>
    @endif

    <button type="submit" id="btn">
        signup
    </button>
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