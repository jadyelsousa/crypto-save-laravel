<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class apiCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:saveBidPriceOnDataBase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esse comando salvará os dados de preço na base de dados com base na criptomoeda informada';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Informe uma criptomoeda');
        $response = Http::get('https://testnet.binancefuture.com/fapi/v1/ticker/bookTicker?symbol='.$name);
        $object = json_decode($response);
        $this->info($object->bidPrice);
    }
}
