<?php

namespace App\Repository;


use App\Models\Car;
use Illuminate\Support\Collection;

/**
 *
 */
class CarRepository
{
    /**
     * @return Car
     */
    public function getAllFreeCars() : Collection{
       return Car::where(['status' => 'free'])->get();
    }
}
