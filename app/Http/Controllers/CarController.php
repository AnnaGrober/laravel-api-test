<?php

namespace App\Http\Controllers;

use App\Repository\CarRepository;
use Illuminate\Http\JsonResponse;



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
     * @OA\Get(
     *     path="/api/v1/cars/free",
     *     summary="Список свободных автомобилей",
     *     tags={"Car"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/definitions/Car")
     *         ),
     *     ),
     * )
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

