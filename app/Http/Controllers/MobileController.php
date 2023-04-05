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
        return response()->json([
            'success'=>true,
            'message'=>'string',
            'data'=>Menu::where('category', $category)
                ->where('id', $id)
                ->get()

            // 'success'=>true,
            // 'message'=>'string',
            // 'data'=>Menu::where('category', $category)
            //     ->where('id', $id)
            //     ->join('meats', 'meats.id', '=', 'menu.meats_id')  
            //     ->join('vegetables', 'vegetables.id', '=', 'menu.vegetables_id')              
            //     ->get()
        ]);
    }



}
