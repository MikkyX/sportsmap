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
            'latitude' => $faker->latitude(-2.7246891434, -0.5325733597),
            'longitude' => $faker->longitude(53.4054960449, 54.9674312464),
            'website' => 'http://'.$faker->domainName(),
            'telephone' => $faker->phoneNumber(),
        ];
    }
);
