<?php

namespace App\Console\Commands\Parse;

use App\Models\Product;
use App\Service\Marketplace\Wildberries;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ParseWildberries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-wildberries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = new Wildberries();
        $data = $service->parseV2();

        if ($data) {
            $cards = Arr::get($data, 'cards');
            if ($cards && count($cards)) {
                foreach ($cards as $card) {
                    print_r($card);
                }
            }
        }
    }
}
