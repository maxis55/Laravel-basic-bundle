<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    $date=Carbon::create(intval(date('Y'))-2, 5, 20, 0, 0, 0);
    $modified_date=$date->addWeeks(rand(1, 52));
    return [
        'name' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'slug' => $faker->unique()->slug,
        'content' => $faker->paragraphs($nbWords = 50, $variableNbWords = true),
        'short_desc' => $faker->paragraphs($nbWords = 3, $variableNbWords = true),
        //comment next line if there is only 1 type of posts in app
        'type'=>$faker->randomElement(\App\Models\Post::POST_TYPES),

        'user_id'=>1,
        'created_at'=>$modified_date,
        'updated_at'=>$modified_date,
    ];
});
