<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'total_price',
        'voucher_code',
        'discount',
        'total_payment',
        'paid',
    ];

    public function orderItem()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function getTotalPriceLocaleAttribute()
    {
        return 'Rp. '.number_format($this->total_price, 0, ',', '.');
    }

    public function getTranDateAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function getTotalPaymentLocaleAttribute()
    {
        return 'Rp. '.number_format($this->total_payment, 0, ',', '.');
    }

    public function getDiscLocaleAttribute()
    {
        return 'Rp. '.number_format($this->discount, 0, ',', '.');
    }

    public function totalBill()
    {
        $price = DB::select("select sum(price * qty) as total from order_item")[0]->total;
        if ($this->voucher_code) {
            $voucher = Discount::where('discount_code', $this->voucher_code)->first();
            $discount = floor($voucher->discount_percentage * $price / 100);
            $price = $price - $discount;
        }
        return 'Rp. '.number_format($price, 0, ',', '.');
    }
}
