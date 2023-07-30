<?php

namespace App\Http\Controllers\Logist;

use App\Http\Controllers\Controller;
use App\Models\MarketplaceType;
use App\Models\Product;
use App\Models\SupplyCalculation;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class LogistController extends Controller
{
    public function index(Request $request, $warehouse = null)
    {
        $incomes = Product::query()->where('status', 'active');
        $incomes = $this->sort($incomes, $request);
        $incomes = $this->filter($incomes, $request);

        $incomes = $incomes->paginate(25);

        $warehouse = $warehouse ? Warehouse::findOrFail($warehouse) : null;
        $wareHouses = Warehouse::query()->whereNull('marketplace_type_id')->get();

        $session = session()->get('message');


        $data = [
            'id' => '#',
            'name' => 'Наименование',
            'image' => 'Картинка',
            'sku' => 'Артикул',
            'price' => 'Цена',
            'colors' => 'Цвета',
            'files' => 'Файлы',
            'sizes' => 'Размеры',
            'income_type' => 'Тип поставки'
        ];

        return view('logist.index', compact('wareHouses', 'session', 'incomes', 'data', 'warehouse'));
    }

    public function supplyCalculation(Request $request, $warehouse = null)
    {
        if (!$warehouse) {
            $warehouse = Warehouse::first();

            if (!$warehouse) {
                abort(404, 'У вас нету складов(обратитесь к администратору)');
            }

            return redirect()->route('logist.supply-calculations', $warehouse->id);
        }
        $warehouse = Warehouse::findOrFail($warehouse);
        $wareHouses = Warehouse::query()->whereNull('marketplace_type_id')->get();


        $supplyCalculations = SupplyCalculation::query()->where('warehouse_id', $warehouse->id);
        $supplyCalculations->join('users', 'supply_calculations.user_id', '=', 'users.id')
            ->join('products', 'supply_calculations.product_id', '=', 'product_id')
        ->select(['supply_calculations.*', 'users.name as user_name', 'products.sku as product_skus']);
        $this->sort($supplyCalculations, $request);
        $this->filter($supplyCalculations, $request);

        $supplyCalculations = $supplyCalculations->paginate(25);
        $session = session()->get('message');

        $data = [
            'id' => '#',
            'user_name' => 'Пользователь',
            'product_sku' => 'Акртикул товара',
            'speed' => 'Скорость продаж (на тот момент)',
            'leftovers' => 'Остатки (на тот момент)',
            'count_products' => 'Остатки (на тот момент)',
            'count_days' => 'Остатки (на тот момент)',
        ];

        return view('logist.supply-calculation', compact('supplyCalculations', 'data', 'session', 'wareHouses'));
    }
}
