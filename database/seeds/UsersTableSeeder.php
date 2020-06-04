<?php

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class, 49)->create();

        App\User::create([
        	'name' => 'Diego Gonzalez',
        	'email'=> 'diegoaliriogm@gmail.com ',
        	'password' => bcrypt('5877802Diego')
        ]);
    }
}
