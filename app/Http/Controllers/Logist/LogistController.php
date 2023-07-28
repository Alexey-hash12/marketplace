<?php

namespace App\Http\Controllers\Logist;

use App\Http\Controllers\Controller;
use App\Models\MarketplaceType;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class LogistController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $incomes = Product::query();
        $incomes = $this->sort($incomes, $request);
        $incomes = $this->filter($incomes, $request);

        $incomes = $incomes->paginate(25);

        $marketPlace = $type ? MarketplaceType::findOrFail($type) : MarketplaceType::query()->where('status', 'ACTIVE')->first();
        $wareHouses = Warehouse::where('marketplace_type_id', $marketPlace->id)->get();

        $session = session()->get('message');


        $data = [
            'id' => '#'
        ];

        return view('logist.index', compact('wareHouses', 'marketPlace', 'session', 'incomes', 'data'));
    }
}
