<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class loadrates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Загружает актуальные курсы валют в формате .json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayDate = date('Y-m-d');
        if (file_exists('/public/rates/' . $todayDate . '.json')) {
            $realCurrencies = file_get_contents('rates/' . $todayDate . '.json');
        } else {
            $realCurrencies = file_get_contents("https://api.exchangerate.host/latest?base=USD");
            file_put_contents('public/rates/' . $todayDate . '.json', $realCurrencies);
        }
        $loadedData = json_decode($realCurrencies, true);
        //$this->rates = $loadedData['rates'];
    }
}
