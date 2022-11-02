<?php

namespace App\Http\Controllers;

use App\Repository\CarRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class CarController extends Controller
{

    private CarRepository $repository;

    /**
     * @param CarRepository $repository
     */
    public function __construct(CarRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function getFreeCars(): JsonResponse
    {
        try {
            return response()->json($this->repository->getAllFreeCars());
        } catch (\Exception $e) {
            throw $e;
        }
    }

}

