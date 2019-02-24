<?php
/**
 * Created by PhpStorm.
 * User: mikkyx
 * Date: 2019-02-24
 * Time: 14:31
 */

use Faker\Generator as Faker;

$factory->define(
    App\Venue::class,
    function (Faker $faker) {
        return [
            'creator_id' => 1,
            'name' => $faker->company(),
            'address' => $faker->streetAddress(),
            'postcode' => $faker->postcode(),
            'latitude' => $faker->latitude(50.656861, 55.068146),
            'longitude' => $faker->longitude(-2.774530, 0.232349),
            'website' => 'http://'.$faker->domainName(),
            'telephone' => $faker->phoneNumber(),
        ];
    }
);
