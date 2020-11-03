<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product' => 'Trufas de Oreo',
            'quantity' => 50
        ]);

        factory(App\Models\Product::class,10)->create();
    }
}
