<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\Marketplace\Wildberries;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ApiController extends Controller
{
    public function supply()
    {

        $service = new Wildberries();
        $data = $service->parseSales();
        if (!$data) {
            return response()->json(['error' => 'Parse Widlberries error']);
        }

        $skus = array();
        $total = array();
        foreach ($data as $datum) {
            if (!in_array($datum['nmId'], $skus)) {
                array_push($skus, $datum['nmId']);
            }

            if (!isset($total[$datum['nmId']])) {
                $total[$datum['nmId']] = 1;
            } else {
                $total[$datum['nmId']] += 1;
            }
        }

        $products = Product::whereIn('sku', $skus)->get();

        $countProducts = array();

        foreach ($products as $product) {
            if (in_array($product->sku, array_keys($total))) {
                // todo get left over
                // todo get product total by the time
                $countProducts[$product->sku] = 1;
//                echo $total[$product->sku];
//                echo "\n";
//                echo $product->name;
//                die();
            }
        }

        return response()->json(['data' => $countProducts]);
    }
}
