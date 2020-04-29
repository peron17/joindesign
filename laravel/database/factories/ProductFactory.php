<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);
    return [
        'name' => $faker->productName,
        'image' => $faker->avatar,
        'price' => rand(100000, 1000000)
    ];
});
