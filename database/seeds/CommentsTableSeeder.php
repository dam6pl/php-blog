<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'post_id' => 3,
            'author'  => 'Łukasz',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean semper arcu arcu. Etiam quis ex elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur pretium dui quis sagittis tincidunt.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
