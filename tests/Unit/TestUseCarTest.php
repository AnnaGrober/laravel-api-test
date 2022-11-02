<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Psy\Exception\ErrorException;
use Psy\Exception\RuntimeException;
use Tests\TestCase;

use App\Services\UseCarService;

class TestUseCarTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testUseCart()
    {
        Artisan::call('db:seed');
        $useCarService = resolve(UseCarService::class);
        $user          = random_int(1, 3);
        $car           = random_int(1, 3);

        $useCar = $useCarService->useCar($user, $car);
        $this->assertTrue($useCar['success']);

        try {
            $useCarService->useCar($user, $car);
        }catch (ErrorException $e){
            $this->assertTrue(true);
        }


        $returnCar =$useCarService->returnCar($user, $car);
        $this->assertTrue($returnCar['success']);

        try {
            $useCarService->returnCar($user, $car);
        }catch (ErrorException $e){
            $this->assertTrue(true);
        }
    }
}
