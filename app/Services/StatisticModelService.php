<?php

namespace App\Services;

use App\Models\Statistic;
use App\Models\Guest;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StatisticModelService
{
    public function __construct(protected Request $request)
    {
    }

    /**
     * createModelStatistic
     *
     * @param  int $roleId
     * @param  int $userId
     * @param  string $type
     * @param  string $action
     * @return void
     */
    public function createModelStatistic(int $roleId, int $userId, string $type, string $action): void
    {
        $data = [
            'role_id' => $roleId,
            'user_id' => $userId,
            'type' => $type,
            'action' => $action,
            'ip_address' => $this->request->ip(),
            'created_at' => date('Y-m-d')
        ];
        $validator = Validator::make($data, Statistic::createValidationRules());
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        Statistic::create($data);
    }

    /**
     * createStatisticOfTypeAction
     *
     * @param  string $type
     * @param  string $action
     * @return void
     */
    public function createStatisticOfTypeAction(string $type, string $action): void
    {
        if (Auth::user() !== null) {
            $this->createModelStatistic(Auth::user()->role_id, Auth::user()->id, $type, $action);
        } else {
            $name = $this->request->session()->get('name', function () {
                $guest = Guest::create(['uuid' => (string) Str::uuid()]);
                $this->request->session()->put('name', $guest->uuid);
            });

            $id = Guest::where('uuid', $name)->value('id');
            if ($id === null) {
                $guest = Guest::create(['uuid' => (string) Str::uuid()]);
                $this->request->session()->put('name', $guest->uuid);
                $id = $guest->id;
            }
            $this->createModelStatistic(Role::ID_GUEST, $id, $type, $action);
        }
    }
}
