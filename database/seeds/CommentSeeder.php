<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'comment' => 'El mejor postre que he probado en mi vida.',
            'user_id' => '2',
            'product_id' => '1'
        ]);

        factory(App\Models\Comment::class,14)->create();
    }
}
