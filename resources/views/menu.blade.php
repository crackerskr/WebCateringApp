<link rel="stylesheet" href="{{asset('style/style.css')}}">

<style>
    .w-5{
        display: none
    }
</style>

<x-navbar />

<div class="home-container">
    <div class="header-container">
        <h2 style="white-space:nowrap"><a href="{{ back()->getTargetUrl()}}" class="color-a"><i class="fa-solid fa-arrow-left"></i></a>{{$category}}</h2>
        <div class="menu-icon-container">
            <a class="btn" href="{{ url('menu/' . $category . '/add') }}">Add Menu</a>
        </div>
    </div>
    @foreach($menuData as $menu)
    <a class="color-a" href="{{ url('menu/' . $menu->id . '/edit') }}">
        <div class="card">
            <div class="order-card-left">
                <h3>{{$menu->name}}</h3>
                <h3>RM {{$menu->price}}</h 3>
            </div>
            <div class="order-card-right">
                <!--TO EDIT MENU-->
                <i class="color-icon fa fa-edit"></i>
                
                <!--TO DELETE MENU-->
                <form action="{{ url('menu/' . $category . '/' . $menu->id . '/delete') }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="border:none; font-size:30px; cursor:pointer" onclick="return confirm('Are you sure you want to delete this menu?')"><i class="color-icon fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
    </a>
    @endforeach
    @if($menuData->total() > 3)
        <div style="margin-top:10px; font-size:20px; text-align:end">
        @if($menuData->previousPageUrl() != '')
            <a class="color-a" style="text-decoration:none" href="{{$menuData->previousPageUrl()}}"><i class="fa-solid fa-arrow-left"></i><span style="margin-right:5px"> Previous </span></a>
        @endif
        @if($menuData->nextPageUrl() != '')
            <a class="color-a" style="text-decoration:none" href="{{$menuData->nextPageUrl()}}"><span style="margin-left:5px"> Next <i class="fa-solid fa-arrow-right"></i></span></a>
        @endif
        </div>
    @endif
</div>

