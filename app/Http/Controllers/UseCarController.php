<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnCarRequest;
use App\Http\Requests\UseCarRequest;
use App\Services\UseCarService;
use Illuminate\Http\JsonResponse;


class UseCarController extends Controller
{

    private UseCarService $service;

    /**
     * @param UseCarService $service
     */
    public function __construct(UseCarService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/car/use",
     *     summary="Арендовать автомобиль",
     *     tags={"Car use"},
     *     description="Арендовать автомобиль",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="query",
     *         description="Car id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Автомобиль успешно взят в использование",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *     )
     * )
     */
    public function useCar(UseCarRequest $request): JsonResponse
    {
        $validate = $request->validated();
        try {
            return response()->json($this->service->useCar($validate['user_id'], $validate['car_id']));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     *  @OA\Post(
     *     path="/api/v1/car/return",
     *     summary="Возвращение автомобиля",
     *     tags={"Car return"},
     *     description="Возвращение автомобиля",
     *      @OA\Parameter(
     *         name="car_id",
     *         in="query",
     *         description="Car id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *       @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Автомобиль возвращен успешно!",
     *     ),
     *      @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Server error",
     *     )
     * )
     */
    public function returnCar(ReturnCarRequest $request): JsonResponse
    {
        $validate = $request->validated();
        try {
            return response()->json($this->service->returnCar($validate['user_id'], $validate['car_id']));
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

