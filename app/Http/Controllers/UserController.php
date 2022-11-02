<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{

    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/free",
     *     summary="Список свободных пользователей",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *         ),
     *     ),
     * )
     */
    public function getFreeUsers(): JsonResponse
    {
        try {
            return response()->json($this->repository->getAllFreeUsers());
        } catch (\Exception $e) {
            throw $e;
        }
    }

}

