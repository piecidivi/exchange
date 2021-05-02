<?php

namespace App\Http\Controllers;

use App\Services\Import\ImportCurrenciesService;
use App\Services\Manage\ShowCurrencyService;

class ImportCurrencyController extends Controller
{
    private ImportCurrenciesService $importCurrenciesService;
    private ShowCurrencyService $showCurrencyService;

    public function __construct(
        ImportCurrenciesService $importCurrenciesService,
        ShowCurrencyService $showCurrencyService)
    {
        $this->importCurrenciesService = $importCurrenciesService;
        $this->showCurrencyService = $showCurrencyService;
    }

    public function import(): string
    {
        $this->importCurrenciesService->execute();
        $currency = $this->showCurrencyService->getAll();

        header("Content-type: application/json");
        return json_encode($currency);
    }
}
