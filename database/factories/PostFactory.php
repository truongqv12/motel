<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = \Illuminate\Support\Str::slug($name);

    $categories = \App\Models\Category::where('cat_type', '=', 'POST')->get()->pluck('cat_id');

    return [
        'pos_title'       => $name,
        'pos_rewrite'     => $slug,
        'pos_image'       => 'https://picsum.photos/200/300/?random=' . $faker->numberBetween(1, 1000),
        'pos_teaser'      => $faker->paragraph,
        'pos_content'     => $faker->randomHtml(),
        'pos_category_id' => $faker->randomElement($categories),
        'pos_is_hot'      => $faker->randomElement([0, 1]),
    ];
});
