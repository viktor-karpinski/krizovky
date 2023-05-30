@extends('master')

@section('content')

<section class="create-container">
    <article class="width-box">
        <div>
            <h2>4</h2>
            <input type="range" min="4" max="25" value="10" class="slider" id="range">
            <h2>25</h2>
        </div>
        <h2 id="showing">10</h2>
    </article>

    <article class="button-box">
        <button class="draw">
            <img src="{{ asset('images/pen.png') }}" alt="image of a pen">
        </button>
        <button class="eraser">
            <img src="{{ asset('images/eraser.png') }}" alt="image of an eraser">  
        </button>
        <button class="clear text">
            clear
        </button>
        <button class="save text">
            save 
        </button>
    </article>

    <p>
        more than 33% needs to be filled out to save
        <br>
        filled out: <span id="percent">0</span>%
    </p>

    <article class="game-box">
        <div id="game">
        
        </div>
    </article>
</section>

<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/draw.js') }}"></script>

@endsection