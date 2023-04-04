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
    // Show Menu in Menu Details
    function showMenu(){
        $menus = Menu::all();
        return response()->json($menus);
    }
}
