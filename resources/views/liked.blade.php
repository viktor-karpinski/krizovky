@extends('master')

@section('content')
<section class="profile-container">
    <h2>
        liked games
    </h2>
</section>
<section class="games-contaienr">
    @foreach ($games as $game)
    <a class="game-link" href="{{ route('game', [$game[0]->name]) }}" data-hover="0">
        <h2>
            {{ $game[0]->name }}
        </h2>
        
        <div>
            <p class="size">
                <img src="{{ asset('images/gb.png') }}" alt="gray rasta" class="gb">
                {{$game[0]->size}} x {{$game[0]->size}}
            </p>
            <aside>
                <p>
                    <img src="{{ asset('images/play.png') }}" alt="image of a play button">
                    {{$game[0]->plays}}
                </p>
                <p>
                    <img src="{{ asset('images/heart.png') }}" alt="imgae of a heart">
                    {{$game[0]->likes}}
                </p>
                <p style="padding-top: 0.7rem">
                    <img src="{{ asset('images/share.png') }}" alt="image of sharing">
                    {{$game[0]->shares}}
                </p>
            </aside>
        </div>
    </a>
    @endforeach
</section>

<section class="pagination">
    
</section>

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
@endsection