<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'product_id',
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function getPriceLocaleAttribute()
    {
        return 'Rp. '.number_format(($this->product->price * $this->qty), 0, ',', '.');
    }
    
    public static function totalPrice()
    {
        $price = DB::select("
        select 
            sum(product.price * cart.qty) as total 
        from 
            cart 
        left join product on cart.product_id = product.id
        ")[0]->total;
        return 'Rp. '.number_format($price, 0, ',', '.');
    }

    public static function checkout()
    {
        try {
            $price = DB::select("
            select 
                sum(product.price * cart.qty) as total 
            from 
                cart 
            left join product on cart.product_id = product.id
            ")[0]->total;

            $order = Order::create([
                'total_price' => $price,
                'voucher_code' => null,
                'discount' => 0,
                'total_payment' => $price
            ]);

            $cart = Cart::all();

            foreach ($cart as $value) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $value->product_id,
                    'qty' => $value->qty,
                    'price' => $value->product->price,
                    'discount' => 0,
                ]);
            }
        } catch (Exception $e) {
            return false;
        }

        return $order;
    }
}
