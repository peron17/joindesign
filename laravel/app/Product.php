<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'image',
        'price',
    ];

    public function getPriceLocaleAttribute()
    {
        return 'Rp. '.number_format($this->price, 0, ',', '.');
    }
}
