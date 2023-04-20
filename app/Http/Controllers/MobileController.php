<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Dessert;
use App\Models\Drink;
use App\Models\Meat;
use App\Models\Menu;
use App\Models\Order;
use App\Models\RiceNnoodle;
use App\Models\Seafood;
use App\Models\User;
use App\Models\Vegetable;
use App\Models\Rating;

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

    // Place Order in OrderScreen
    function placeOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'billing_name' => 'required',
            'contact_no' => 'required|string|min:10|max:11|regex:/[0-9]{9}/',
            'address' => 'required',
            'delivery_date' => ['required', 'after_or_equal:' . now()->addDays(7)],
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $order = new Order();
        $order->billing_name = $request->input('billing_name');
        $order->contact_no = $request->input('contact_no');
        $order->address = $request->input('address');
        $order->delivery_date = new \DateTime($request->input('delivery_date'));
        $order->amount = $request->input('amount');
        $order->menu_id = $request->input('menu_id');
        $order->user_id = $request->input('user_id');
        $order->status = 2;
        $order->save();
     
        $ord = $order->find($order->id);

        return response()->json([
            'success'=> true,
            'message'=> 'Order placed successfully',
            'data'=> $ord->join('Menu', 'menu.id', '=', 'orders.menu_id')
                ->join('Users', 'users.id', '=', 'orders.user_id')
                ->select('orders.*', 'menu.name as menu_name',
                'menu.category as menu_category')
                ->where('orders.id', $order->id)
                ->first()
        ]);
    }

    // Show Order History in View Profile Screen
    function showOrderHistory($id){
        $orders = Order::where('orders.user_id', $id)
                ->whereIn('orders.status', [1, 3])
                ->join('Menu', 'menu.id', '=', 'orders.menu_id')
                ->join('Users', 'users.id', '=', 'orders.user_id')
                ->select('orders.*', 'menu.name as menu_name',
                'menu.category as menu_category', 
                'menu.min_order_amount as menu_min_order_amount')
                ->get();

        return response()->json([
            'success'=>true,
            'message'=>'string',
            'data'=> $orders,
        ]);
    }

    // Show Pending Order only in Track Order List Screen
    function showTrackOrderList($id){
        $orders = Order::where('orders.user_id', $id)
                ->where('orders.status', 2)
                ->join('Menu', 'menu.id', '=', 'orders.menu_id')
                ->join('Users', 'users.id', '=', 'orders.user_id')
                ->select('orders.*', 'menu.name as menu_name',
                'menu.category as menu_category',
                'menu.price as menu_price')
                ->orderBy('orders.delivery_date', 'desc')
                ->get();

        return response()->json([
            'success'=>true,
            'message'=>'string',
            'data'=> $orders,
        ]);
    }

    // Cancel Order in Track Screen (update the status to 3)
    function cancelOrder($id){
        $data = Order::find($id);
        $data->status = 3;
        $data->save();  

        return response()->json([
            'success'=>true,
            'message'=>'Order has been cancelled.',
        ]);      
    }

    // Insert Rating
    function rating(Request $request, $id){
        $validator = Validator::make($request->all(), [            
            'rating' => 'number',
        ]);

        $data = new Rating();
        $data->rating = $request->input('rating');
        $data->order_id = $id;
        $data->date = date('Y-m-d H:i:s');;
        $data->save();

        return response()->json([
            'success'=> true,
            'message'=> 'Thank you for the rating.',
            'data'=> $data,
        ]);
    }

    // Show Rating
    function showRating($id){
        $rating = Rating::where('order_id', $id)->first();
        
        if(is_null($rating)){
            return response()->json([
                'success'=> false,
            ]);
        }else{
            return response()->json([
                'success'=> true,
                'data' => $rating
            ]);
        }
    }

}
