<?php

use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 10)->create()->each(
            function (Product $product) {
                $product->vouchers()->saveMany(factory(Voucher::class, 2)->make());
            }
        );
    }
}
