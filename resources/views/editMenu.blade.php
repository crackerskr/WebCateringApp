<link rel="stylesheet" href="{{asset('style/style.css')}}">

<x-navbar />

<div class="menu-container">
    <h2><a href="{{ back()->getTargetUrl()}}" class="color-a"><i class="fa-solid fa-arrow-left"></i></a>Edit Menu</h2>

    <form action="/editMenu" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" hidden id="id" name="id" value="{{ $menu->id }}" style="display:none"/>
    <input type="hidden" hidden id="category" name="category" value="{{$menu->category}}" style="display:none"/>

        <div class="menuContent">
            <div class="menuLabel">
                <label for="name">Menu Name</label>
            </div>
            <div class="menuInput">
                <input type="text" class="input" id="name" name="name" value="{{$menu->name}}"/>
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <label for="name">Menu Price/pax</label>
            </div>
            <div class="menuInput">
                <input type="text" class="input" id="price" name="price" value="{{$menu->price}}"/>
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <label for="name">Min Order Amount</label>
            </div>
            <div class="menuInput">
                <input type="text" class="input" id="amount" name="amount" value="{{$menu->min_order_amount}}">
            </div>
        </div>
 
        <div class="menuContent">
            <div class="menuLabel">
                <label for="food">Food Included</label>
            </div>
            <div class="menuInput food-container">
                <div class="foodRow">
                    <h4 class="menuLabel">Meats: </h4>
                    <select class="foodInput" id="meats_id" name="meats_id">
                        @foreach($meatData as $meat)
                            @if ($menu->meats_id == $meat->id)
                            <option selected value="{{ $meat->id }}">{{ $meat->name }}</option>
                            @else
                            <option value="{{ $meat->id }}">{{ $meat->name }}</option> 
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Seafoods: </h4>
                    <select class="foodInput" id="seafoods_id" name="seafoods_id">
                        @foreach($seafoodData as $seafood)
                            @if ($menu->seafoods_id == $seafood->id)
                            <option selected value="{{ $seafood->id }}">{{ $seafood->name }}</option>
                            @else
                            <option value="{{ $seafood->id }}">{{ $seafood->name }}</option> 
                            @endif
                        @endforeach                  
                    </select>    
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Vegetables: </h4>
                    <select class="foodInput" id="vegetables_id" name="vegetables_id">
                        @foreach($vegetableData as $vegetable)
                            @if ($menu->vegetables_id == $vegetable->id)
                            <option selected value="{{ $vegetable->id }}">{{ $vegetable->name }}</option>
                            @else
                            <option value="{{ $vegetable->id }}">{{ $vegetable->name }}</option> 
                            @endif
                        @endforeach                  
                    </select>    
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Rice & Noodles: </h4>
                    <select class="foodInput" id="riceNnoodles_id" name="riceNnoodles_id">
                        @foreach($riceNnoodleData as $riceNnoodle)
                            @if ($menu->riceNnoodles_id == $riceNnoodle->id)
                            <option selected value="{{ $riceNnoodle->id }}">{{ $riceNnoodle->name }}</option>
                            @else
                            <option value="{{ $riceNnoodle->id }}">{{ $riceNnoodle->name }}</option> 
                            @endif
                        @endforeach                   
                    </select>    
                </div> 
                <div class="foodRow">
                    <h4 class="menuLabel">Desserts: </h4>
                    <select class="foodInput" id="desserts_id" name="desserts_id">
                        @foreach($dessertData as $dessert)
                            @if ($menu->desserts_id == $dessert->id)
                            <option selected value="{{ $dessert->id }}">{{ $dessert->name }}</option>
                            @else
                            <option value="{{ $dessert->id }}">{{ $dessert->name }}</option> 
                            @endif
                        @endforeach                    
                    </select>    
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Drinks: </h4>
                    <select class="foodInput" id="drinks_id" name="drinks_id">
                        @foreach($drinkData as $drink)
                            @if ($menu->drinks_id == $drink->id)
                            <option selected value="{{ $drink->id }}">{{ $drink->name }}</option>
                            @else
                            <option value="{{ $drink->id }}">{{ $drink->name }}</option> 
                            @endif
                        @endforeach                  
                    </select>    
                </div>
            </div>
        </div>
        <div class="formContent">
            <button type="submit" class="btn">Edit Menu</button>
        </div>
    </form>

</div>