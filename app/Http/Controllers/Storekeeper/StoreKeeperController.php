<?php

namespace App\Http\Controllers\Storekeeper;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\MarketplaceType;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class StoreKeeperController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index(Request $request, $type = null)
    {
        $incomes = Income::query();
        $incomes = $this->sort($incomes, $request);
        $incomes = $this->filter($incomes, $request);

        $incomes = $incomes->paginate(25);

        $marketPlace = $type ? MarketplaceType::findOrFail($type) : MarketplaceType::query()->where('status', 'ACTIVE')->first();
        $wareHouses = Warehouse::where('marketplace_type_id', $marketPlace->id)->get();

        $session = session()->get('message');

        return view('store-keeper.index', compact('wareHouses', 'marketPlace', 'session', 'incomes'));
    }
}
