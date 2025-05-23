<link rel="stylesheet" href="{{asset('style/style.css')}}">

<x-navbar/>

<div class="foodHome-container">
    <div class="foodHomeRow">
        <a href="{{ url('/food/meat') }}" class="foodHomeCol">    
            <i class="fa-solid fa-drumstick-bite" style="color: #ffffff;"></i>
            <h1>Meats</h1>
        </a>
        <a href="{{ url('/food/seafood') }}" class="foodHomeCol">
            <i class="fa-solid fa-fish-fins" style="color: #ffffff;"></i>
            <h1>Seafoods</h1>
        </a>
        <a href="{{ url('/food/vegetable') }}" class="foodHomeCol">
            <i class="fa-solid fa-carrot" style="color: #ffffff;"></i>
            <h1>Vegetables</h1>
        </a>
    </div>
    <div class="foodHomeRow">
        <a href="{{ url('/food/riceNnoodle') }}" class="foodHomeCol">
            <i class="fa-solid fa-bowl-rice" style="color: #ffffff;"></i>
            <h1>Rice & Noodles</h1>
        </a>
        <a href="{{ url('/food/drink') }}" class="foodHomeCol">
            <i class="fa-solid fa-champagne-glasses" style="color: #ffffff;"></i>
            <h1>Drinks</h1>
        </a>
        <a href="{{ url('/food/dessert') }}" class="foodHomeCol">
            <i class="fa-solid fa-cookie" style="color: #ffffff;"></i>            
            <h1>Desserts</h1>
        </a>
    </div>
</div>