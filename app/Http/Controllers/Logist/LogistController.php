<?php

namespace App\Http\Controllers\Logist;

use App\Http\Controllers\Controller;
use App\Models\MarketplaceType;
use App\Models\Product;
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
}
