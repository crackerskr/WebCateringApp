<link rel="stylesheet" href="{{asset('style/style.css')}}">

<x-navbar />

<div class="menu-container">
    
    <h2><a href="{{ url('menu/' . $category ) }}" class="color-a"><i class="fa-solid fa-arrow-left"></i></a>Add Menu</h2>

    <form action="/addMenu" method="POST">
    @csrf

    <input type="hidden" hidden id="category" name="category" value="{{$category}}" style="display:none"/>

        <div class="menuContent">
            <div class="menuLabel">
                <label for="name">Menu Name</label>
            </div>
            <div class="menuInput">
                <input type="text" class="input" id="name" name="name" placeholder="Enter menu name">
                <span style="color:red;font-weight:bold">@error('name'){{$message}}@enderror</span><br>
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <label for="name">Menu Price/pax</label>
            </div>
            <div class="menuInput">
                <input type="text" class="input" id="price" name="price" placeholder="Enter menu price">
                <span style="color:red;font-weight:bold">@error('price'){{$message}}@enderror</span><br>
            </div>
        </div>

        <div class="menuContent">
            <div class="menuLabel">
                <label for="name">Min Order Amount</label>
            </div>
            <div class="menuInput">
                <input type="text" class="input" id="amount" name="amount" placeholder="Enter min order amount">
                <span style="color:red;font-weight:bold">@error('amount'){{$message}}@enderror</span><br>
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
                        <option disabled selected>Please select</option>
                        @foreach($meatData as $meat)
                            <option value="{{ $meat->id }}">{{ $meat->name }}</option> 
                        @endforeach
                    </select>
                    <span style="color:red;font-weight:bold">@error('meats_id'){{$message}}@enderror</span><br>
                    <!-- <a href="{{ url('/food/meat') }}" class="color-a"><i class="add-icon fa-solid fa-square-plus"></i></a> -->
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Seafoods: </h4>
                    <select class="foodInput" id="seafoods_id" name="seafoods_id">
                        <option disabled selected>Please select</option>
                            @foreach($seafoodData as $seafood)
                                <option value="{{ $seafood->id }}">{{ $seafood->name }}</option> 
                            @endforeach                   
                    </select>   
                    <span style="color:red;font-weight:bold">@error('seafoods_id'){{$message}}@enderror</span><br> 
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Vegetables: </h4>
                    <select class="foodInput" id="vegetables_id" name="vegetables_id">
                        <option disabled selected>Please select</option>
                            @foreach($vegetableData as $vegetable)
                                <option value="{{ $vegetable->id }}">{{ $vegetable->name }}</option> 
                            @endforeach                   
                    </select>    
                    <span style="color:red;font-weight:bold">@error('vegetables_id'){{$message}}@enderror</span><br>
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Rice & Noodles: </h4>
                    <select class="foodInput" id="riceNnoodles_id" name="riceNnoodles_id">
                        <option disabled selected>Please select</option>
                            @foreach($riceNnoodleData as $riceNnoodle)
                                <option value="{{ $riceNnoodle->id }}">{{ $riceNnoodle->name }}</option> 
                            @endforeach                   
                    </select>    
                    <span style="color:red;font-weight:bold">@error('riceNnoodles_id'){{$message}}@enderror</span><br>
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Desserts: </h4>
                    <select class="foodInput" id="desserts_id" name="desserts_id">
                        <option disabled selected>Please select</option>
                            @foreach($dessertData as $dessert)
                                <option value="{{ $dessert->id }}">{{ $dessert->name }}</option> 
                            @endforeach                   
                    </select>    
                    <span style="color:red;font-weight:bold">@error('desserts_id'){{$message}}@enderror</span><br>
                </div>
                <div class="foodRow">
                    <h4 class="menuLabel">Drinks: </h4>
                    <select class="foodInput" id="drinks_id" name="drinks_id">
                        <option disabled selected>Please select</option>
                            @foreach($drinkData as $drink)
                                <option value="{{ $drink->id }}">{{ $drink->name }}</option> 
                            @endforeach                   
                    </select>    
                    <span style="color:red;font-weight:bold">@error('drinks_id'){{$message}}@enderror</span><br>
                </div>
            </div>
        </div>
        <div class="formContent">
            <button type="submit" class="btn">Add Menu</button>
        </div>
    </form>

</div>