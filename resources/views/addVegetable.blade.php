<link rel="stylesheet" href="{{asset('style/style.css')}}">

<x-navbar />

<div class="addFood-container">
    
    <h2><a href="{{ url('/food') }}" class="color-a"><i class="fa-solid fa-arrow-left"></i></a>Add Vegetable</h2>

    <div class="menuContent">
            <div class="menuLabel">
                <label for="food">List of Vegetables</label>
            </div>
            <div class="menuInput food-container">
                @foreach($data as $vegetable)
                    <h3>{{ $vegetable->name }}
                         <!--TO DELETE FOOD-->
                        <form action="{{ url('deleteVegetable/' . $vegetable->id ) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border:none; font-size:25px; cursor:pointer; background-color:white" onclick="return confirm('Are you sure you want to delete this food?')"><i class="color-icon fa-solid fa-trash"></i></button>
                        </form>
                    </h3> 
                    
                @endforeach   
            </div>
    </div>

    <form action="/addVegetable" method="POST">
    @csrf    
        <div class="menuContent">
            <div class="menuLabel">
                <label for="name">Vegetable Name</label>
            </div>
            <div class="menuInput">
                <input type="text" class="input" id="name" name="name" placeholder="Enter vegetable name">
                <span style="color:red;font-weight:bold">@error('name'){{$message}}@enderror</span><br>
            </div>
        </div>
        <div class="formContent">
            <button type="submit" class="btn">Add Food</button>
        </div>
    </form>

</div>