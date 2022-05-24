<?php

namespace App\Console\Commands;

use App\Models\CryptoCurrency;
use Illuminate\Console\Command;

class CheckCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:checkAvgBigPrice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esse comando deverá verificar o preço médio e informar se o preço (último) está menor 0.5% do que o preço médio.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    // Aqui ele pega o valor da média de bidprice, limitado aos 100 últimos valores inseridos.
       $media = CryptoCurrency::latest()->limit(100)->get()->avg('bidPrice');
    //  Depois pega o valor da última criptomoeda inserida
       $ultimoPreco =  CryptoCurrency::latest()->first('bidPrice');
       if ($media > $ultimoPreco->bidPrice) { // verifico pra não fazer cálculo caso a moeda não tenha dimiduído.
           $percentual = ($media - $ultimoPreco->bidPrice)*100/$media; // verifica o percentual de diminuição da moeda
            if ($percentual >= 0.5) { // verifica se o percentual de diminuição é maior do que 0.5%
                return $this->info('A moeda atual diminuiu mais de 0.5% em relação a media.');
            }
            return $this->warn('A moeda atual diminuiu menos que 0.5% em relação a média.');

       }else {
        return $this->warn('O valor da moeda atual é maior que a média.');
       }
    }
}
