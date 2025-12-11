<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 *
 */
class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'is_ordered',
    ];

    /*public function user() {
        return $this->belongsTo(User::class);
    }*/

    public function products() {
        return $this->belongsToMany(Product::class,
            'carts_products', 'cart_id',
            'product_id')
            ->withPivot('id', 'cart_id', 'product_id');
    }
}
