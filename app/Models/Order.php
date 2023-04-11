<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }

    public function getMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }


}
