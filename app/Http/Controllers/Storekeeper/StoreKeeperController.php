<?php

namespace App\Http\Controllers\Storekeeper;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\MarketplaceType;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;
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

    public function leftovers(Request $request, $warehouse = null)
    {
        if (!$warehouse) {
            $warehouse = Warehouse::first();

            if (!$warehouse) {
                abort(404, 'У вас нету складов(обратитесь к администратору)');
            }

            return redirect()->route('store-keeper.leftovers', $warehouse->id);
        }
        $warehouse = Warehouse::findOrFail($warehouse);

        $incomes = Product::query()->where('status', 'active')
            ->whereNull('deleted_at')
            ->join('warehouse_products', function ($join) {
                $join->on('products.id', '=', 'warehouse_products.product_id');
            })
            ->join('warehouses', function ($join) {
                $join->on('warehouses.id', '=', 'warehouse_products.warehouse_id');
            })
            ->select('products.*', 'products.id as item_id', 'warehouses.id as warehouses_id','warehouses.name as warehouse_name', 'warehouse_products.left_count as product_left_count')->where('warehouses.id', $warehouse->id);

        $incomes = $this->sort($incomes, $request);
        $incomes = $this->filter($incomes, $request);

        $products = $incomes->paginate(25);
        $wareHouses = Warehouse::query()->whereNull('marketplace_type_id')->get();

        $session = session()->get('message');
        $data = [
            'id' => '#',
            'name' => 'Наименование',
            'image' => 'Картинка',
            'sku' => 'Артикул',
            'price' => 'Цена',
            'product_left_count' => 'Остаток на складе',
            'income_type' => 'Тип поставки'
        ];

        return view('store-keeper.leftovers', compact('products', 'wareHouses', 'warehouse', 'session', 'data'));
    }

    public function addLeftOver(Request $request)
    {
        $product = WarehouseProduct::where('product_id', $request->leftover_id)->where('warehouse_id', $request->warehouseid)->firstOrFail();
        $product->left_count = $request->value;
        $product->save();

        session()->flash('message', 'Вы успешно изменили остатки на складе');

        return back();
    }
}
