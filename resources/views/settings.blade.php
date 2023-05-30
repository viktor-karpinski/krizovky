@extends('master')

@section('content')
<section class="profile-container extra">
    <h2>
        Settings
    </h2>

    <a href="{{ route('liked') }}">
        Liked games
    </a>

    <a href="{{ route('won') }}">
        Won games
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            logout
        </button>
    </form>
</section>
@endsection