<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dessert;
use App\Models\Drink;
use App\Models\Meat;
use App\Models\Menu;
use App\Models\Order;
use App\Models\RiceNnoodle;
use App\Models\Seafood;
use App\Models\User;
use App\Models\Vegetable;

class WebController extends Controller
{
    // Show Menu in Homepage
    function showMenu($category){
        $menuData = Menu::where('category', $category)->paginate(3);
        return view('menu', compact('menuData', 'category'));
    }

    // Show Food Include in Add Menu
    function showFoodInclude($category){
        $meatData = Meat::all();
        $seafoodData = Seafood::all();
        $vegetableData = Vegetable::all();
        $riceNnoodleData = RiceNnoodle::all();
        $dessertData = Dessert::all();
        $drinkData = Drink::all();
        return view('addMenu', compact('meatData','seafoodData','riceNnoodleData','vegetableData','dessertData','drinkData','category'));
    }

    //Add Menu
    function addMenu(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => ['required ','regex: /^\d{0,8}(\.\d{1,2})?$/'],
            'amount' => 'required | integer | gte:20',
            'meats_id' => 'required',
            'seafoods_id' => 'required',
            'vegetables_id' => 'required',
            'riceNnoodles_id' => 'required',
            'desserts_id' => 'required',
            'drinks_id' => 'required',
        ]);

        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->price = $request->input('price');
        $menu->min_order_amount = $request->input('amount');
        $menu->meats_id = $request->input('meats_id');
        $menu->seafoods_id = $request->input('seafoods_id');        
        $menu->vegetables_id = $request->input('vegetables_id');
        $menu->riceNnoodles_id = $request->input('riceNnoodles_id');
        $menu->desserts_id = $request->input('desserts_id');
        $menu->drinks_id = $request->input('drinks_id');
        $menu->category = $request->input('category');
        $menu->save();

        return redirect('/menu/'. $request->input('category'));
    }

    // Edit Menu
    function updateMenu(Request $request){
        $menu = Menu::find($request->id);

        $request->validate([
            'name' => 'required',
            'price' => ['required ','regex: /^\d{0,8}(\.\d{1,2})?$/'],
            'amount' => 'required | integer | gte:20',
            'meats_id' => 'required',
            'seafoods_id' => 'required',
            'vegetables_id' => 'required',
            'riceNnoodles_id' => 'required',
            'desserts_id' => 'required',
            'drinks_id' => 'required',
        ]); 

        $menu->name = $request->input('name');
        $menu->price = $request->input('price');
        $menu->min_order_amount = $request->input('amount');
        $menu->meats_id = $request->input('meats_id');
        $menu->seafoods_id = $request->input('seafoods_id');        
        $menu->vegetables_id = $request->input('vegetables_id');
        $menu->riceNnoodles_id = $request->input('riceNnoodles_id');
        $menu->desserts_id = $request->input('desserts_id');
        $menu->drinks_id = $request->input('drinks_id');
        $menu->category = $request->input('category');
        $menu->save();

        return redirect('/menu/'. $request->input('category'));
    }
    // Show Menu Details in Edit Menu
    function showMenuDetails($id)
    {
        $menu = Menu::find($id);
        $meatData = Meat::all();
        $seafoodData = Seafood::all();
        $vegetableData = Vegetable::all();
        $riceNnoodleData = RiceNnoodle::all();
        $dessertData = Dessert::all();
        $drinkData = Drink::all();

        return view('editMenu', compact('menu','meatData','seafoodData','riceNnoodleData','vegetableData','dessertData','drinkData'));
    }

    // Delete Menu
    function deleteMenu($category, $id){
        $order = Menu::find($id);
        $order->delete();      
        return redirect('/menu/'. $category);
    }

    // Show Order
    function showOrder(){
        $orders = Order::orderby('delivery_date', 'desc')->paginate(3);
        $menuData = Menu::all();
        return view ('order', compact('orders','menuData'));
    }

    // Show Order Details
    function showOrderDetails($id){
        $order = Order::find($id);
        $menuData = Menu::all();
        return view ('orderDetails', compact('order', 'menuData'));
    }
    
    // Update Order Status to Complete 
    function completeOrder(Request $request, $id){
        $data = Order::find($id);
        $data->status = 1;
        $data->save();
        return redirect('/order/'. $id);
    }

    // Update Order Status to Cancelled
    function cancelOrder(Request $request, $id){
        $data = Order::find($id);
        $data->status = 3;
        $data->save();
        return redirect('/order/'. $id);
    }

    // Show Food Include in Add Food
    function showAllFood($category){
        switch ($category) {
            case 'meat':
                $data = Meat::all();
                $view = 'addMeat';
                break;
            case 'seafood':
                $data = Seafood::all();
                $view = 'addSeafood';
                break;
            case 'vegetable':
                $data = Vegetable::all();
                $view = 'addVegetable';
                break;
            case 'riceNnoodle':
                $data = RiceNnoodle::all();
                $view = 'addRiceNnoodle';
                break;
            case 'drink':
                $data = Drink::all();
                $view = 'addDrink';
                break;
            case 'dessert':
                $data = Dessert::all();
                $view = 'addDessert';
                break;
            default:
                abort(404); // Return a 404 error for invalid categories
        }
        
        return view($view, compact('data'));
    }

    // Add Meat
    function addMeat(Request $request){
        $request->validate([
            'name' => 'required|unique:meats',
        ]);

        $meat = new Meat();
        $meat->name = $request->input('name');
        $meat->save();

        return redirect('/food/meat')->with('success', 'Meat name added successfully!');
    }

    // Delete Meat
    function deleteMeat($id){
        $meat = Meat::find($id);
        $meat->delete();      
        return redirect('/food/meat');
    }

    // Add Seafood
    function addSeafood(Request $request){
        $request->validate([
            'name' => 'required|unique:seafoods',
        ]);

        $seafood = new Seafood();
        $seafood->name = $request->input('name');
        $seafood->save();

        return redirect('/food/seafood')->with('success', 'Seafood name added successfully!');
    }

    // Delete Seafood
    function deleteSeafood($id){
        $seafood = Seafood::find($id);
        $seafood->delete();      
        return redirect('/food/seafood');
    }

    // Add Vegetable
    function addVegetable(Request $request){
        $request->validate([
            'name' => 'required|unique:vegetables',
        ]);

        $vegetable = new Vegetable();
        $vegetable->name = $request->input('name');
        $vegetable->save();

        return redirect('/food/vegetable')->with('success', 'Vegetable name added successfully!');
    }

    // Delete Vegetable
    function deleteVegetable($id){
        $vegetable = Vegetable::find($id);
        $vegetable->delete();      
        return redirect('/food/vegetable');
    }

    // Add RiceNnoodle
    function addRiceNnoodle(Request $request){
        $request->validate([
            'name' => 'required|unique:riceNnoodles',
        ]);

        $riceNnoodle = new RiceNnoodle();
        $riceNnoodle->name = $request->input('name');
        $riceNnoodle->save();

        return redirect('/food/riceNnoodle')->with('success', 'Seafood name added successfully!');
    }

    // Delete RiceNnoodle
    function deleteRiceNnoodle($id){
        $riceNnoodle = RiceNnoodle::find($id);
        $riceNnoodle->delete();      
        return redirect('/food/riceNnoodle');
    }

    // Add Drink
    function addDrink(Request $request){
        $request->validate([
            'name' => 'required|unique:drinks',
        ]);

        $drink = new Drink();
        $drink->name = $request->input('name');
        $drink->save();

        return redirect('/food/drink')->with('success', 'Drink name added successfully!');
    }

    // Delete Drink
    function deleteDrink($id){
        $drink = Drink::find($id);
        $drink->delete();      
        return redirect('/food/drink');
    }
    
    // Add Dessert
    function addDessert(Request $request){
        $request->validate([
            'name' => 'required|unique:desserts',
        ]);

        $dessert = new Dessert();
        $dessert->name = $request->input('name');
        $dessert->save();

        return redirect('/food/dessert')->with('success', 'Dessert name added successfully!');
    }

    // Delete Dessert
    function deleteDessert($id){
        $dessert = Dessert::find($id);
        $dessert->delete();      
        return redirect('/food/dessert');
    }

}
