<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function pageBuy()
    {
        event('viewPageBuy');
        return view('buy');
    }

    public function pageDownload()
    {
        event('viewPageDowload');
        return view('download');
    }

    public function click()
    {
        event('clickPageBuy');
        return view('buy');
    }

    public function download(Request $request)
    {
        event('clickPageDownload');
        return view('download');
    }

    public function report()
    {
        return view('report');
    }

    public function statistic()
    {
        return view('statistic');
    }
}
