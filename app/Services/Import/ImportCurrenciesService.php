<?php

namespace App\Services\Import;

use App\Models\Currency;

class ImportCurrenciesService
{
    public function execute(): void
    {
        $xmlString = file_get_contents("https://www.bank.lv/vk/ecb.xml");
        $xmlObject = simplexml_load_string($xmlString);

        $json = json_encode($xmlObject);
        $response = json_decode($json, true);

        foreach ($response["Currencies"]["Currency"] as $currency) {
            Currency::updateOrCreate([
                "symbol" => $currency["ID"]
            ], [
                "symbol" => $currency["ID"],
                "rate" => (int)((float)$currency["Rate"] * 100000)
            ]);
        }

        Currency::updateOrCreate([
            "symbol" => "EUR"
        ], [
            "symbol" => "EUR",
            "rate" => 100000
        ]);
    }
}
