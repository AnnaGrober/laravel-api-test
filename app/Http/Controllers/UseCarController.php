<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnCarRequest;
use App\Http\Requests\UseCarRequest;
use App\Services\UseCarService;
use Illuminate\Http\JsonResponse;

/**
 *
 */
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
     * @param UseCarRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
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
     * @param UseCarRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
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

