@extends('master')

@section('content')
<section class="profile-container">
    <article>
        <h2>
            {{ $user->name }}
        </h2>
        @if(Auth::check() && $user->id === Auth::user()->id)
        <a href="{{ route('settings') }}">
            <img src="{{ asset('images/settings.png') }}">
        </a>
        @endif
    </article>
    <article>
        <p>
            Games: {{$user->levels}}
        </p>
        <p>
            Likes: {{$user->likes()}}
        </p>
        <p>
            Plays: {{$user->plays()}}
        </p>
    </article>
    
    <article>
        <p>
            Won Games: {{$user->completed()}}
        </p>
        <p>
            Liked Games: {{$user->liked()}}
        </p>
    </article>
</section>

<section class="games-contaienr">
    @foreach ($games as $game)
    <a class="game-link" href="{{ route('game', [$game->name]) }}" data-hover="0">
        <h2>
            {{ $game->name }}
        </h2>
        
        <div>
            <p class="size">
                <img src="{{ asset('images/gb.png') }}" alt="gray rasta" class="gb">
                {{$game->size}} x {{$game->size}}
            </p>
            <aside>
                <p>
                    <img src="{{ asset('images/play.png') }}" alt="">
                    {{$game->plays}}
                </p>
                <p>
                    <img src="{{ asset('images/heart.png') }}" alt="">
                    {{$game->likes}}
                </p>
                <p style="padding-top: 0.7rem">
                    <img src="{{ asset('images/share.png') }}" alt="image of sharing">
                    {{$game->shares}}
                </p>
            </aside>
        </div>
    </a>
    @endforeach

    <script>
    window.onload = () => {
        let games = document.getElementsByClassName('game-link')
        for(let i = 0; i < games.length; i++) {
            color(games[i], true)
            //setColor($(games[i]).find('.size').find('img'), true, games[i])
        }
    }
    </script>
    <script src="{{ asset('js/hover.js') }}"></script>
</section>
@endsection