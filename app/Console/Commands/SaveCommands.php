<?php

namespace App\Console\Commands;

use App\Models\CryptoCurrency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isNull;

class SaveCommands extends Command
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
        if(isset($name)){
            try {
                // chama api através de um método get, passando a moeda informada.
                $response = Http::get('https://testnet.binancefuture.com/fapi/v1/ticker/bookTicker?symbol='.$name);
                $object = json_decode($response); // converte json para objeto php
                $crypto = new CryptoCurrency(); // crio uma nova instância de moeda no banco de dados e salvo
                $crypto->symbol = $object->symbol;
                $crypto->bidPrice = $object->bidPrice;
                $crypto->save();
                return $this->info('Dados da criptomoeda salvos!');
            } catch (\Throwable $th) {
                 return $this->error('Não foi possível salvar os dados com o valor informado, tente novamente!');
            }
        }
        $this->error('Digite um valor válido');
   }
}
