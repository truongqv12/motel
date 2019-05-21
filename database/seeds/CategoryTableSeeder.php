<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'cat_name' => 'Phòng trọ',
            'cat_rewrite' => \Illuminate\Support\Str::slug('Phòng trọ', '-'),
            'cat_parent_id' => 0,
            'cat_type' => 'MOTEL',
        ]);

        factory(\App\Models\Category::class, 4)->create();

    }
}
