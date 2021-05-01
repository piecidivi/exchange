<?php

namespace App\Http\Controllers;

use App\Rules\Symbols;
use App\Services\Manage\ConvertCurrencyService;
use App\Services\Manage\ShowCurrencyService;
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
            "dir" => ["required", "in:cur1,cur2"],
            "num" => ["required", "regex:/^[\d\.]+$/"]
        ], [
            "cur1.required" => "Currency to convert missing.",
            "cur2.required" => "Currency to convert missing.",
            "dir.required" => "Conversion not selected.",
            "dir.in" => "Conversion not selected.",
            "num.required" => "Amount of money to convert missing.",
            "num.regex" => "Amount of money can contain numbers and '.' as decimal only."
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 401);
        }

        $cur1 = $this->showCurrencyService->getBySymbol($request["cur1"]);
        $cur2 = $this->showCurrencyService->getBySymbol($request["cur2"]);
        $num = intval($request["num"]);

        $conversion = $request["dir"] === "cur2" ? $this->convertCurrencyService->convert($cur1, $cur2, $num) :
            $this->convertCurrencyService->convert($cur2, $cur1, $num);

        return response()->json($conversion);
    }
}
