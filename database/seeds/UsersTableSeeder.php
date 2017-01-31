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
        $user = factory('App\User',10)->create([
            'password' => bcrypt('123456'),
            'sex'=> randomElement($array = ['f','m']),
            'birthday' => date($format = 'Y-m-d', $max = 'now'),
            'money' => 0,

        ]);
    }
}
