<?php

use App\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        //Create Super Admin
        $user = new User();
        $user->name = 'jedi';
        $user->email= 'encefalosas@gmail.com';
        $user->password = bcrypt('Encefalo2015');
        $user->save();
    }
}
