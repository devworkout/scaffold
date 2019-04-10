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
        factory(\App\User::class)->create(
        /*>>*/
            [
                'name' => 'Vladislav Otchenashev',
                'email' => 'librevlad@gmail.com',
                'password' => bcrypt('secret'),
            ]
        /*<<*/
        );
    }
}