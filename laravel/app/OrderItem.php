<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'discount',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function disc()
    {
        return $this->belongsTo('App\Discount', 'discount');
    }

    public function getPriceLocaleAttribute()
    {
        return 'Rp. '.number_format($this->price, 0, ',', '.');
    }

    public function getPriceTotalLocaleAttribute()
    {
        return 'Rp. '.number_format((($this->price * $this->qty) - $this->discount), 0, ',', '.');
    }

    public function getDiscAttribute()
    {
        return 'Rp. '.number_format($this->discount, 0, ',', '.');
    }

}
