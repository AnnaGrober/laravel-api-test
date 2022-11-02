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
            'id'       => 1,
            'name'     => 'Anna',
            'email'    => 'anna@test.ru',
            'password' => '12345678',
            'active'   => 0,
        ],
        [
            'id'       => 2,
            'name'     => 'Sonya',
            'email'    => 'sonya@test.ru',
            'password' => '12345678',
            'active'   => 0,
        ],
        [
            'id'       => 3,
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
            User::where('id', $item['id'])->delete();
            $user           = new User();
            $user->id       = $item['id'];
            $user->name     = $item['name'];
            $user->email    = $item['email'];
            $user->password = \Illuminate\Support\Facades\Hash::make($item['password']);
            $user->save();
        }
    }
}
