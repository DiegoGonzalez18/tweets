<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Tweet::class, function (Faker $faker) {
    return [
        //
        'content'=> $faker->text(99),
        'id_user'=>rand(1,30)

    ];
});
