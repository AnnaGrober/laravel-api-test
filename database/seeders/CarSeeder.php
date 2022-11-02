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
            'id'     => 1,
            'name'   => 'Toyota',
            'number' => '123ABC161',
        ],
        [
            'id'     => 2,
            'name'   => 'Ford focus',
            'number' => '767NBT161',
        ],
        [
            'id'     => 3,
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
            Car::where('id', $item['id'])->delete();
            $car         = new Car();
            $car->id     = $item['id'];
            $car->name   = $item['name'];
            $car->number = $item['number'];
            $car->save();
        }
    }
}
