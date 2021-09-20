<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvertorController extends Controller
{
    protected $rates = [
        "usd" => 1,
        "rub" => 0.01344,
        "eur" => 1.18,
        "chf" => 1.1,
        "jpy" => 0.01
    ];
    public function currenciesList()
    {
        $result = implode(", ", array_keys($this->rates));
        return $result;
    }
    public function currenciesListArr()
    {
        return $this->rates;
    }
    /**
     * Метод конвертации валюты
     * 
     * @param string $from Имя валюты "из"
     * @param string $to Имя валюты "в"
     * @param float $amount Сумма
     * @return float
     */
    public function convert(string $from, string $to, float $amount)
    {
        $result = $amount / $this->rates[$from] * $this->rates[$to];
        return $result;
    }
}
