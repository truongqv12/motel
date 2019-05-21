<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = \Illuminate\Support\Str::slug($name);
    $types = ['POST'];
    $categories = \App\Models\Category::all()->pluck('cat_id');
    if (count($categories) <= 4) {
        $categories = [0];
    } else {
        $categories = $categories->toArray();
    }

    return [
        'cat_name' => $name,
        'cat_rewrite' => $slug,
        'cat_parent_id' => $faker->randomElement($categories),
        'cat_type' => $faker->randomElement($types),
    ];
});
