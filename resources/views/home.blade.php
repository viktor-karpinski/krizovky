@extends('master')

@section('content')
<form class="search-container">
    <article class="search-input-wrapper">
        <input type="text" name="search" id="search" placeholder="search...">
        <button type="submit">
            <img src="{{ asset('images/search.png') }}">
        </button>
    </article>
    <button id="filter-switch" type="button">
        Search Filter 
        <img src="{{ asset('images/settings.png') }}">
    </button>
    <div class="filter-wrapper">
        <article class="width-box">
            <div>
                <h2>4</h2>
                <input type="range" min="4" max="25" value="10" class="slider" id="range">
                <h2>25</h2>
            </div>
            <h2 id="showing">10</h2>
        </article>
    </div>
</form>
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
                    <img src="{{ asset('images/play.png') }}" alt="image of a play button">
                    {{$game->plays}}
                </p>
                <p>
                    <img src="{{ asset('images/heart.png') }}" alt="imgae of a heart">
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
</section>

<section class="pagination">
    
</section>

<script>
    window.onload = () => {
        hrColor('.slider', false)
        hrColor('.search-input-wrapper', true)
        let games = document.getElementsByClassName('game-link')
        for(let i = 0; i < games.length; i++) {
            color(games[i], true)
            //setColor($(games[i]).find('.size').find('img'), true, games[i])
        }
    }

    $('#range').on('input change', () => {
        let size = $('#range').val()
        $('#showing').text(size)
    })

    $('#filter-switch').on('click', () => {
        $('.filter-wrapper').toggleClass('open')
    })
</script>
<script src="{{ asset('js/hover.js') }}"></script>
@endsection