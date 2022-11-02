<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

/**
 *
 */
class CarSeeder extends Seeder
{
    private $cars = [
        [
            'name'   => 'Toyota',
            'number' => '123ABC161',
        ],
        [
            'name'   => 'Ford focus',
            'number' => '767NBT161',
        ],
        [
            'name'   => 'BMW black',
            'number' => '654ATB161',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->cars as $item) {
            $car         = new Car();
            $car->name   = $item['name'];
            $car->number = $item['number'];
            $car->save();
        }
    }
}
