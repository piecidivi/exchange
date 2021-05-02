<?php

namespace App\Http\Controllers;

use App\Rules\Symbols;
use App\Services\Manage\ConvertCurrencyService;
use App\Services\Manage\ShowCurrencyService;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ConvertCurrencyController extends Controller
{
    private ConvertCurrencyService $convertCurrencyService;
    private ShowCurrencyService $showCurrencyService;

    public function __construct(
        ConvertCurrencyService $convertCurrencyService,
        ShowCurrencyService $showCurrencyService)
    {
        $this->convertCurrencyService = $convertCurrencyService;
        $this->showCurrencyService = $showCurrencyService;
    }

    public function convert(Request $request): string
    {
        $validator = Validator::make($request->all(), [
            "cur1" => ["required", new Symbols],
            "cur2" => ["required", new Symbols],
            "num" => ["required", "regex:/^[\d\.]+$/"]
        ], [
            "cur1.required" => "Currency to convert missing.",
            "cur2.required" => "Currency to convert missing.",
            "num.required" => "Amount of money to convert missing.",
            "num.regex" => "Amount of money can contain numbers and '.' as decimal only."
        ]);

        if ($validator->fails()) {
            header("Content-type: application/json");
            return json_encode(["FAIL", $validator->errors()]);
        }

        $cur1 = $this->showCurrencyService->getBySymbol($request["cur1"]);
        $cur2 = $this->showCurrencyService->getBySymbol($request["cur2"]);
        $amount = floatval($request["num"]);

        try {
            $conversion = $this->convertCurrencyService->convert($cur1, $cur2, $amount);
        } catch (Exception $exception) {
            header("Content-type: application/json");
            return json_encode(["FAIL", $exception->getMessage()]);
        }

        header("Content-type: application/json");
        return json_encode(["OK", $conversion]);
    }
}
