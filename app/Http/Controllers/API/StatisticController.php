<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\StatisticService;

class StatisticController extends Controller
{
    public function __construct(protected StatisticService $statisticService)
    {
    }
    /**
     * Display a listing of the all users with filter for attributes.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        //  return $request->all();
        $request->validate(Statistic::getValidationRules());

        $header = [
            'Date',
            'name',
            'action',
            'type',
            'ip_adress'
        ];
        $builder = Statistic::orderBy('created_at');
        $builder = $this->statisticService->filter($request, $builder);
        $dataChart = $this->statisticService->baseListChart($builder, $header);
        usort($dataChart, function ($a, $b) {
            return $a[0] <=> $b[0];
        });
        array_unshift($dataChart, $header);

        return response()->json($dataChart);
    }
}
