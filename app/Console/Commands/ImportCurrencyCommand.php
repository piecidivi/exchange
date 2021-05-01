<?php

namespace App\Console\Commands;

use App\Services\Import\ImportCurrenciesService;
use Illuminate\Console\Command;

class ImportCurrencyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import currency exchange rate from bank.lv (xml file).';

    private ImportCurrenciesService $importCurrenciesService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportCurrenciesService $importCurrenciesService)
    {
        parent::__construct();
        $this->importCurrenciesService = $importCurrenciesService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        echo "Importing...\n";
        $this->importCurrenciesService->execute();
        echo "Currency import completed.\n";
        return 0;
    }
}
