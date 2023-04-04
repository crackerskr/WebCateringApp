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
        // $menuData = Menu::where('id',$)
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
        $orders = Order::paginate(3);
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
}
