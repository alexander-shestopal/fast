<?php

namespace App\Http\Controllers\API;

use App\Models\Statistic;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function index(): JsonResponse
    {
        $header = [
            'Date',
            'login',
            'logout',
            'register',
            'view_buy',
            'view_download',
            'click_buy',
            'click_download'
        ];
        $chartBase = array_fill_keys($header, 0);
        $dataChart = [$header];
        $statistics = Statistic::select('id', 'type', 'created_at')->orderBy('created_at')->get()->groupBy(['created_at', 'type']);
        foreach ($statistics as $key => $date) {
            $data = $chartBase;
            $data['Date'] = $key;
            foreach ($date as $index => $item) {
                $data[$index] = count($item);
            }
            array_push($dataChart, array_values($data));
        }
        unset($statistics);

        return response()->json($dataChart);
    }
}
