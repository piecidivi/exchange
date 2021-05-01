<?php

namespace App\Http\Controllers;


use App\Services\Manage\ShowCurrencyService;


class HomeController extends Controller
{
    private ShowCurrencyService $showCurrencyService;

    public function __construct(ShowCurrencyService $showCurrencyService)
    {
        $this->showCurrencyService = $showCurrencyService;
    }

    public function index(): string
    {
        $currency = json_encode($this->showCurrencyService->getAll());
        return view("index")->with("currency", $currency);
    }
}
