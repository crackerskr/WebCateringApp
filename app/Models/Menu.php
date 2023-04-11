<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'Menu';
    
    public $timestamps = false;

    const MENU_CATEGORY = ['Buffet Menu','The Chef Menu','Western Menu', 'Mini BUffet'];

    protected $fillable = ['name','price','category','min_order_amount'];

    public function getOrder()
    {
        return $this->hasMany(Order::class);
    }
    
    public function getMeat()
    {
        return $this->belongsTo(Meat::class);
    }

    public function getSeafood()
    {
        return $this->belongsTo(Seafood::class);
    }

    public function getVegetable()
    {
        return $this->belongsTo(Vegetable::class);
    }
    
    public function getRiceNnoodle()
    {
        return $this->belongsTo(RiceNnoodle::class);
    }
    
    public function getDessert()
    {
        return $this->belongsTo(Dessert::class);
    }    
    
    public function getDrink()
    {
        return $this->belongsTo(Drink::class);
    }
}
