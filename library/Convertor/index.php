<?php
include "Lukmanov/RealConvertor.php";
include "Lukmanov/Web.php";
$convertor = new RealConvertor();
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    // TODO: Определить, что обращение идёт через браузер и выполнить код ниже
    $data = [];
    $data['currenciesList'] = $convertor->currenciesListArr();
    $data['from'] = $_POST['from'] ?? 'USD';
    $data['to'] = $_POST['to'] ?? 'RUB';
    $data['amount'] = $_POST['amount'] ?? '';
    // TODO: Выводить верный результат
    if (empty($data['amount'])) {$data['result'] = 'Здесь будет результат!';} else {
    $data['amount'] = str_replace(',', '.', $data['amount']);
    $result = $convertor->convert($data['from'], $data['to'], $data['amount']);
    $result = number_format($result, 2, ',', ' ');
    $result = str_replace(',', '.', $result);
    $result = floatval($data['amount']) . " " . $convertor->getFullName($data['from']) . " = <br>" . $result . " " . $convertor->getFullName($data['to']);
    $data['result'] = $result;}
    PageLoader::load("main", $data);
} else {
    // TODO: А если к приложению обратились через консоль, то запускать код ниже:
    echo "Поддерживаемые валюты " . $convertor->currenciesList();
    echo "\n";
    $sourcecurrency = readline("Укажите валюту из которой хотите конвертировать: ");
    $sourcecurrency = strtoupper($sourcecurrency);
    if (!in_array($sourcecurrency, array_keys($convertor->currenciesListArr()))) {
        echo "Неправильное значение валюты!\n";
        exit;
    }
    $finalcurrency = readline("Укажите валюту, в которую хотите конвертировать: ");
    $finalcurrency = strtoupper($finalcurrency);
    if (!in_array($finalcurrency, array_keys($convertor->currenciesListArr()))) {
        echo "Неправильное значение валюты!\n";
        exit;
    }
    $amount = readline("Введите количество $sourcecurrency: ");
    $amount = str_replace(',', '.', $amount);
    if (!is_numeric($amount)) {
        echo "Введено неправильное значение! Можно вводить только цифры!\n";
        exit;
    }
    $result = $convertor->convert($sourcecurrency, $finalcurrency, $amount);
    $result = number_format($result, 2, ',', ' ');
    echo floatval($amount) . " " . $convertor->getFullName($sourcecurrency) . " = " . $result . " " . $convertor->getFullName($finalcurrency) . " \n";
    $putinFile = floatval($amount) . " " . $convertor->getFullName($sourcecurrency) . " = " . $result . " " . $convertor->getFullName($finalcurrency) . " \n";
    file_put_contents('log.txt', $putinFile, FILE_APPEND);
}
