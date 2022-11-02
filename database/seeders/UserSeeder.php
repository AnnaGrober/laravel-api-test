<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 *
 */
class UserSeeder extends Seeder
{

    private $users = [
        [
            'name'     => 'Anna',
            'email'    => 'anna@test.ru',
            'password' => '12345678',
            'active'   => 0,
        ],
        [
            'name'     => 'Sonya',
            'email'    => 'sonya@test.ru',
            'password' => '12345678',
            'active'   => 0,
        ],
        [
            'name'     => 'Ivan',
            'email'    => 'ivan@test.ru',
            'password' => '12345678',
            'active'   => 0,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->users as $item) {
            $user           = new User();
            $user->name     = $item['name'];
            $user->email    = $item['email'];
            $user->password = \Illuminate\Support\Facades\Hash::make($item['password']);
            $user->save();
        }
    }
}
