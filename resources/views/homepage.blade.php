<link rel="stylesheet" href="{{asset('style/style.css')}}">

<x-navbar/>

<div class="home-container">
    <div class="homeRow">
        <a href="{{ route('menu', ['category' => 'Buffet Menu']) }}" class="homeCol">    
            <img src="{{ asset('images/buffetmenu.png') }}" alt="None" />
            <h1>Buffet Menu</h1>
        </a>
        <a href="{{ route('menu', ['category' => 'The Chef Menu']) }}" class="homeCol">
            <img src="{{ asset('images/thechef.png') }}" alt="None" />
            <h1>The Chef Menu</h1>
        </a>
    </div>
    <div class="homeRow">
        <a href="{{ route('menu', ['category' => 'Western Menu']) }}" class="homeCol">
            <img src="{{ asset('images/westernmenu.png') }}" alt="None" />
            <h1>Western Menu</h1>
        </a>
        <a href="{{ route('menu', ['category' => 'Mini Buffet']) }}" class="homeCol">
            <img src="{{ asset('images/minibuffet.png') }}" alt="None" />
            <h1>Mini Buffet</h1>
        </a>
    </div>
</div>