<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'login' => 'admin',
            'password' => bcrypt('admin'),
            'display_name' => 'Administrator bloga',
            'is_admin' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'login' => 'mgorski',
            'password' => bcrypt('mgorski'),
            'display_name' => 'Michał Górski',
            'is_admin' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
