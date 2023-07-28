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
        $data = $service->parse();

        foreach ($data as $item) {
            if (!$product = Product::where('sku', Arr::get($item, 'nmId'))->first()) {
                $product = new Product();
            }
            $product->sku = Arr::get($item, 'nmId');
            $product->instance_id = Arr::get($item, 'barcode');
            $product->price = Arr::get($item, 'Price');
            $product->name = Arr::get($item, 'supplierArticle');
            $product->save();
        }

        $data = $service->parseV2();

        if ($data) {
            $cards = Arr::get($data, 'cards');
            if ($cards && count($cards)) {
                foreach ($cards as $card) {
                    $product = Product::where('sku', Arr::get($card, 'nmID'))->first();
                    if (!$product) {
                        continue;
                    }

                    $product->files = Arr::get($card, 'mediaFiles');
                    $sizes = Arr::get($card, 'sizes');
                    $productSizes = array();
                    foreach ($sizes as $size) {
                        array_push($productSizes, $size['techSize']);
                    }
                    $product->sizes = $productSizes;
                    $product->colors = Arr::get($card, 'colors');
                    $product->save();
                    $this->info('.');
                }
            }
        }
    }
}
