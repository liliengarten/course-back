<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'cart_id'];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
