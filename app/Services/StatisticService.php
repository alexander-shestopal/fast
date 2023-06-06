<?php

namespace App\Services;

use App\Models\Statistic;
use App\Models\Guest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Builder;

class StatisticService
{
    public function __construct(protected Request $request)
    {
    }
    /**
     * filter for attributes.
     *
     * @param  Request $request
     * @return Builder $builder
     */
    public function filter(Request $request, Builder $builder): Builder
    {
        if (count($request->type) > 0) {
            $builder = $builder->whereIn('type', $request->type);
        }
        if (count($request->action) > 0) {
            $builder = $builder->whereIn('action', $request->action);
        }
        if ($request->has('name')) {
            $user = User::where('name', $request->name)->first();
            if ($user !== null) {
                $builder =  $builder->where('user_id', $user->id)->where('role_id', '<>', Role::ID_GUEST);
            } else {
                $guest = Guest::where('uuid', $request->name)->first();
                if ($guest !== null) {
                    $builder =  $builder->where('user_id', $guest->id)->where('role_id', Role::ID_GUEST);
                }
            }
        }
        if ($request->has('startDate') || $request->has('endDate')) {
            $startDate = $request->startDate ?: Statistic::oldest()->first()->created_at;
            $endDate = $request->endDate ?: Statistic::latest()->first()->created_at;
            $builder =  $builder->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $builder;
    }

    /**
     * baseListChart
     *
     * @param  Builder $builder
     * @param  array $header
     * @return array
     */
    public function baseListChart(Builder $builder, array $header): array
    {
        $dataChart = [];
        $chartBase = array_fill_keys($header, 0);
        $statistics = $builder->get();
        foreach ($statistics as $item) {
            $data = $chartBase;
            $data['Date'] = $item['created_at'];
            $data['name'] = $this->getModel($item->role_id)->OfTypeUser($item->user_id);
            $data['action'] = $item['action'];
            $data['type'] = $item['type'];
            $data['ip_adress'] = $item['ip_address'];
            array_push($dataChart, array_values($data));
        }
        unset($statistics);

        return $dataChart;
    }

    /**
     * Get Model
     *
     * @param  int $roleId
     * @return Model
     */
    protected function getModel(int $roleId): Model
    {
        return match ($roleId) {
            Role::ID_GUEST => new Guest(),
            Role::ID_USER => new User(),
            default => new User()
        };
    }
}
