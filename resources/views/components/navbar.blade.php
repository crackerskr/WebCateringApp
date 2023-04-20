<link rel="stylesheet" href="{{asset('style/navbar.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
      integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class='top'>
    <div class='header'>
        <x-logo />
        <h1>WELCOME TO LAM CATERING FOOD MANAGEMENT</h1>
    </div>

    <div class='navbar'>
        <a class='left' href="{{route('homepage')}}"><i class="fa fa-home"></i> MENU</a>

        {{-- Menu dropdown 
        <div class="dropdown">
            <button class="dropbtn"><a>MENU <i class="fa fa-caret-down"></i></a></button>
            <div class="dropdown-content">
                <a href="{{url('menu/' . $menu->category . '/Buffet Menu')}}">BUFFET MENU</a>
                <a href="{{url('menu/' . $menu->category . '/The Chef Menu')}}">THE CHEF MENU</a>
                <a href="{{url('menu/' . $menu->category . '/Western Menu')}}">WESTERN MENU</a>
                <a href="{{url('menu/' . $menu->category . '/Mini Buffet')}}">MINI BUFFET</a>
            </div>
        </div> --}}
        <a class='left' href="/food">FOOD</a>
        <a class='left' href="/order">ORDER</a>
        <a class='right' href="/logout"><i class="fa fa-sign-out"></i></a>
    </div>
</div>
