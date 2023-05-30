<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krizovky</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/color.js') }}"></script>
</head>
<body>

    <header>
        <h1>
            <a href="{{ route('dashboard') }}" class="link">
                Krizovky
            </a>
        </h1>
        <nav>
            <a href="{{ route('dashboard') }}" class="link">
                home
            </a>
            <a href="{{ route('create') }}" class="link">
                create
            </a>
            <a href="{{ route('search') }}" class="link">
                search
            </a>
            <a href="{{ route('profile') }}" class="link">
                profile
            </a>
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>

    <footer>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque dicta quidem, odit natus aperiam ipsa impedit dignissimos nihil beatae amet.
        </p>
        <article>
            <nav>
                <a href="{{ route('dashboard') }}" class="link">
                    home
                </a>
                <a href="{{ route('create') }}" class="link">
                    create
                </a>
                <a href="{{ route('search') }}" class="link">
                    search
                </a>
                <a href="{{ route('profile') }}" class="link">
                    profile
                </a>
            </nav>
            <nav>
                <a href="{{ route('about') }}" class="link">
                    about
                </a>
                <a href="{{ route('privacy-policy') }}" class="link">
                    privacy policy
                </a>
                <a href="{{ route('imprint') }}" class="link">
                    imprint
                </a>
            </nav>
        </article>
    </footer>
    
    <script>
        color('header', true)
        var style = (function() {
            // Create the <style> tag
            var style = document.createElement("style");

            // WebKit hack
            style.appendChild(document.createTextNode('::selection { background-color: ' + getColor() + '; }'));

            // Add the <style> element to the page
            document.head.appendChild(style);
        
            return style;
        })();

        hrColor('footer', true)
    </script>
</body>
</html>