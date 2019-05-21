<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\AdminUser::count() == 0) {
            \App\Models\AdminUser::create([
                'name' => 'Trần Trọng Trường',
                'email' => 'truongqv13@gmail.com',
                'phone' => '0379573155',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'admin_isadmin' => 1,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
            ]);
        }
    }
}
