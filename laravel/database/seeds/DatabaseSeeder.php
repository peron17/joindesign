<?php

use App\Discount;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Product::truncate();
        Discount::truncate();

        factory(Product::class, 50)->create();
        factory(Discount::class, 10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
