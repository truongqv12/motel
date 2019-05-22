<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('admin_user')->truncate();
        $this->call(AdminUserTableSeeder::class);
        \Illuminate\Support\Facades\DB::table('categories')->truncate();
        $this->call(CategoryTableSeeder::class);
//        $this->call(PostsTableSeeder::class);
    }
}
