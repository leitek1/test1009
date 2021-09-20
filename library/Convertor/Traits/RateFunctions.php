<?php
trait RateFunctions
{
    public function getFullName($shortName)
    {
        $currencyNames = file_get_contents('symbols/symbols.json');
        $loadedData = json_decode($currencyNames, true);
        $loadedData = $loadedData['symbols'];
        $result = $loadedData[$shortName]['description'];
        return $result;
    }
}
