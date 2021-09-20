<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Storage::disk('local');
//use library\Convertor\Traits\RateFunctions;
class RealConvertorController extends ConvertorController
{
    //use RateFunctions;
    public function getFullName($shortName)
    {
        $currencyNames = file_get_contents('symbols/symbols.json');
        $loadedData = json_decode($currencyNames, true);
        $loadedData = $loadedData['symbols'];
        $result = $loadedData[$shortName]['description'];
        return $result;
    }
    public function loadRates()
    {
        $todayDate = date('Y-m-d');
        if (file_exists('rates/' . $todayDate . '.json')) {
            $realCurrencies = file_get_contents('rates/' . $todayDate . '.json');
        } else {
            $realCurrencies = file_get_contents("https://api.exchangerate.host/latest?base=USD");
            file_put_contents('rates/' . $todayDate . '.json', $realCurrencies);
        }
        $loadedData = json_decode($realCurrencies, true);
        $this->rates = $loadedData['rates'];
    }
    public function convert(string $from, string $to, $amount)
    {
        $from = strtoupper($from);
        $to = strtoupper($to);
        $result = $amount / $this->rates[$from] * $this->rates[$to];
        return $result;
    }
    function __construct()
    {
        $this->loadRates();
    }
}
