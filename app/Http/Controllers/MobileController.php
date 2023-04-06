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

class MobileController extends Controller
{
    // Show Menu in Menu Screen
    function showMenu($category){
        return response()->json([
            'success'=>true,
            'message'=>'string',
            'data'=>Menu::where('category', $category)->get()
        ]);
    }

    // Show Menu Details in Menu Details Screen
    function showMenuDetails($category, $id){
        $menu = Menu::where('category', $category)
                ->where('menu.id', $id)
                ->join('Meats', 'meats.id', '=', 'menu.meats_id')
                ->join('Seafoods', 'seafoods.id', '=', 'menu.seafoods_id')
                ->join('Vegetables', 'vegetables.id', '=', 'menu.vegetables_id')
                ->join('RiceNnoodles', 'riceNnoodles.id', '=', 'menu.riceNnoodles_id')
                ->join('Desserts', 'desserts.id', '=', 'menu.desserts_id')
                ->join('Drinks', 'drinks.id', '=', 'menu.drinks_id')
                ->select('menu.*', 'meats.name as meat_name', 
                    'seafoods.name as seafood_name', 
                    'vegetables.name as vegetable_name',
                    'riceNnoodles.name as riceNnoodle_name',
                    'desserts.name as dessert_name',
                    'drinks.name as drink_name')
                ->first();

        return response()->json([
            'success'=>true,
            'message'=>'string',
            'data'=> $menu,
        ]);
    }



}
