<?php

namespace App\Services;

use App\Models\Car;
use App\Models\CarUsedHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Psy\Exception\ErrorException;

/**
 *
 */
class UseCarService
{

    /**
     * @param int $userId
     * @param int $carId
     *
     * @return array
     * @throws \Exception
     */
    public function useCar(int $userId, int $carId)
    {
        DB::beginTransaction();
        try {
            $car = Car::find($carId);
            if ($car->status === 'used') {
                DB::rollBack();
                throw new ErrorException('Автомобиль уже используется!', 422);
            }
            $car->status = 'used';
            if (!$car->save()) {
                DB::rollBack();
                throw new \RuntimeException('Car save error!');
            }

            $user = User::find($userId);
            if ($user->active === 1) {
                DB::rollBack();
                throw new ErrorException('Пользователь уже использует автомобиль!', 422);
            }
            $user->active      = 1;
            $user->used_car_id = $car->id;
            if (!$user->save()) {
                DB::rollBack();
                throw new \RuntimeException('User save error!');
            }

            if (!$this->saveHistory($carId, $userId)) {
                DB::rollBack();
                throw new \RuntimeException('History save error!');
            }

            DB::commit();

            return ['success' => true, 'car' => $car, 'user' => $user, 'message' => 'Автомобиль успешно взят в использование!'];
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function returnCar(int $userId, int $carId)
    {
        DB::beginTransaction();
        try {
            $car = Car::find($carId);
            if ($car->stats === 'free') {
                DB::rollBack();
                throw new ErrorException('Автомобиль не используется!', 422);
            }
            $car->status = 'free';
            if (!$car->save()) {
                DB::rollBack();
                throw new \RuntimeException('Car save error!');
            }

            $user = User::find($userId);
            if ($user->active === 0) {
                DB::rollBack();
                throw new ErrorException('Этот пользователь не использует автомобиль!', 422);
            }
            $user->active      = 0;
            $user->used_car_id = null;
            if (!$user->save()) {
                DB::rollBack();
                throw new \RuntimeException('User save error!');
            }

            $history = CarUsedHistory::where('car_id', $carId)->where('user_id', $userId)->where('finished_at', null)->first();

            if (!$this->finishedHistory($history)) {
                DB::rollBack();
                throw new \RuntimeException('History save error!');
            }

            DB::commit();

            return ['success' => true, 'message' => 'Автомобиль возвращен успешно!'];
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param int $carId
     * @param int $userId
     *
     * @return bool
     */
    private function saveHistory(int $carId, int $userId): bool
    {
        $history             = new CarUsedHistory();
        $history->car_id     = $carId;
        $history->user_id    = $userId;
        $history->started_at = Carbon::now()->toDateString();

        return $history->save();
    }

    /**
     * @param CarUsedHistory $history
     *
     * @return bool
     */
    private function finishedHistory(CarUsedHistory $history): bool
    {
        $history->finished_at = Carbon::now()->toDateString();

        return $history->save();
    }

}
