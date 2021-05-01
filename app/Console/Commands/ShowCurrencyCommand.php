<?php

namespace App\Console\Commands;

use App\Services\Manage\ShowCurrencyService;
use Illuminate\Console\Command;

class ShowCurrencyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:show {symbol}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show currency rate.';

    private ShowCurrencyService $showCurrencyService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ShowCurrencyService $showCurrencyService)
    {
        parent::__construct();
        $this->showCurrencyService = $showCurrencyService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $currency = $this->showCurrencyService->getBySymbol($this->argument("symbol"));
        $rate = number_format($currency->rate / 1000000, 2);
        echo "{$currency->symbol} {$rate}\n";
        return 0;
    }
}
