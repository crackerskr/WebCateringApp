<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function getMenu()
    {
        return $this->hasMany(Menu::class);
    }
}
