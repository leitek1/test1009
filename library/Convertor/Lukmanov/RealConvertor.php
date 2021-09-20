<?php
//include "library/Convertor/Lukmanov/Convertor.php";
//include "library/Convertor/Traits/RateFunctions.php";
class RealConvertor extends Convertor
{
    use RateFunctions;
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
