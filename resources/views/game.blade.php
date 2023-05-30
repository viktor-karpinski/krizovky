@extends('master')

@section('sidebar')
    @parent
@endsection

@section('content')
<section class="create-container">

    <article class="game-header">
        @if($like)
            @if($liked)
            <button id="like" class="liked">
                <img src="{{ asset('images/heart.png') }}" alt="heart image">
            </button>
            @else
            <button id="like">
                <img src="{{ asset('images/heart.png') }}" alt="heart image">
            </button>
            @endif
        @else
         <button id="like" disabled="true">
            <img src="{{ asset('images/heart.png') }}" alt="heart image">
        </button>
        <input type="hidden" value="{{ asset('images/heart.png') }}" id="heart">
        @endif
        <h2>
            {{$game->name}}
        </h2>
    </article>

    <article class="game-header smaller">
        <button id="share">
            <img src="{{ asset('images/share.png') }}" alt="share image">
        </button>
        <h2>
            Created by <a href="{{route('user', [$game->user()->name])}}">{{ $game->user()->name }}</a>
        </h2>
    </article>

    <article class="game-box" data-size="{{ $game->size }}" data-game="{{ $game->game }}" data-name="{{ $game->name }}">
        <div class="up"></div>
        <div class="down">
            <div class="number-left-box"></div>
            <div id="game">
            
            </div>
            <div class="button-box left">
            <button class="draw">
                <img src="{{ asset('images/pen.png') }}" alt="image of a pen">
            </button>
            <button class="eraser">
                <img src="{{ asset('images/eraser.png') }}" alt="image of an eraser"> 
            </button>
            <button class="placeholder">
                <img src="{{ asset('images/placeholder.png') }}" alt="image of an X"> 
            </button>
            </div>
        </div>
    </article>

    <article class="button-box bottom">
        <button class="draw">
            <img src="{{ asset('images/pen.png') }}" alt="image of a pen">
        </button>
        <button class="eraser">
            <img src="{{ asset('images/eraser.png') }}" alt="image of an eraser"> 
        </button>
        <button class="placeholder">
            <img src="{{ asset('images/placeholder.png') }}" alt="image of an X"> 
        </button>
        <input type="hidden" value="{{csrf_token()}}" id="token_play">
        <input type="hidden" value="{{csrf_token()}}" id="token_win">
        <input type="hidden" value="{{csrf_token()}}" id="token_like">
    </article>

    <article class="button-box">
        <button id="confetti" class="hidden text">
            confetti
        </button>
    </article>
</section>

<canvas id="win"></canvas>

@if(Auth::check() && $game->user()->id === Auth::user()->id)
<form class="auth-form" action="{{ route('delete', [$game->name]) }}" method="POST" id="delete">
    @csrf
    @method('DELETE')
    <button type="submit" id="btn">
        delete your game
    </button>
</form>
@endif

@if(!$like && Auth::check())
<script>
function heart() {
    $('#like').attr('disabled', false)
}
</script>
@else
<script>
function heart() {
    
}
</script>
@endif
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/win.js') }}"></script>
<script src="{{ asset('js/game.js') }}"></script>

@endsection
