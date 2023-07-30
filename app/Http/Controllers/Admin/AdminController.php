<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Leftover;
use App\Models\MarketplaceType;
use App\Models\Product;
use App\Models\Token;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $session = session()->get('message');

        $marketPlaces = MarketplaceType::query();

        $marketPlaces = $marketPlaces->paginate(25);

        return view('admin.index', compact('session', 'marketPlaces'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function products(Request $request)
    {
        $products = Product::query()->select('products.*');

        $products = $this->sort($products, $request);
        $products = $this->filter($products, $request);
        $products = $products->paginate(25);

        $session = session()->get('message');
        $error = session()->get('error');

        $warehouses = Warehouse::get();
        $data = [
            'id' => '#',
            'instance_id' => 'Id в системе маркеплэйса',
            'name' => 'Наименование',
            'sku' => 'Артикул',
            'status' => 'Статус',
            'price' => 'Цена',
            'sizes' => 'Размеры',
            'colors' => 'Цвета',
            'files' => 'Файлы',
            'income_type' => 'Тип поставки'
        ];

        return view('admin.products', compact('products', 'session', 'warehouses', 'data', 'error'));
    }

    public function closeProduct(Request $request)
    {
        $closeId = $request->close_id;
        $product = Product::findOrFail($closeId);
        $product->status = 'closed';
        $product->save();
        session()->flash('message', 'Вы успешно вывели из продажи продукт');

        return back();
    }

    public function storeProducts(Request $request)
    {
        $product = Product::create(
            $request->only([
                'instance_id',
                'marketplace_type_id',
                'name',
                'sku',
                'price',
                'sizes',
                'colors',
                'files',
                'income_type'
            ])
        );

        $product->warehouses()->sync($request->warehouses ?? []);

        session()->flash('message', 'Вы успешно создали продукт');

        return back();
    }

    public function deleteProducts(Request $request)
    {
        $token = Product::findOrFail($request->delete_id);
        $token->warehouses()->sync([]);
        $token->delete();
        session()->flash('message', 'Вы успешно удалили продукт');
        return back();
    }

    public function warehouseStore(Request $request)
    {
        $token = Product::findOrFail($request->product_id);
        $token->warehouses()->sync($request->warehouses);

        session()->flash('message', 'Вы успешно указали склады продукта');
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function incomes(Request $request)
    {
        $incomes = Income::query()->with('marketplace');

        $incomes = $incomes->paginate(25);

        $session = session()->get('message');
        $error = session()->get('error');

        return view('admin.incomes', compact('incomes', 'session', 'error'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function users(Request $request)
    {
        $users = User::query();
        $users = $this->sort($users, $request);
        $users = $this->filter($users, $request);

        $users = $users->paginate(25);
        $session = session()->get('message');
        $error = session()->get('error');

        $data = [
            'id' => '#',
            'name' => 'Имя',
            'email' => 'Почта',
            'role' => 'Роль',
            'created_at' => 'Дата создания'
        ];

        return view('admin.users', compact('users', 'session', 'data', 'error'));
    }

    public function storeUsers(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => $request->role
        ]);

        session()->flash('message', 'Вы успешно создали пользователя');


        return back();
    }

    public function deleteUsers(Request $request)
    {
        $token = User::findOrFail($request->delete_id);
        $token->delete();
        session()->flash('message', 'Вы успешно удалили пользователя');
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function token(Request $request)
    {
        $tokens = Token::query()->join('marketplace_types', 'tokens.marketplace_id', '=', 'marketplace_types.id')
        ->select('tokens.*', DB::raw('marketplace_types.name as marketplace_name'));
        $tokens = $this->sort($tokens, $request);
        $tokens = $this->filter($tokens, $request);
        $tokens = $tokens->paginate(25);
        $session = session()->get('message');
        $error = session()->get('error');

        return view('admin.tokens', compact('tokens', 'session', 'error'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeToken(Request $request)
    {
        $token = Token::create($request->all());

        session()->flash('message', 'Вы успешно создали токен');

        return back();
    }

    public function deleteToken(Request $request)
    {
        $token = Token::findOrFail($request->token_id);
        $token->delete();
        session()->flash('message', 'Вы успешно удалили токен');
        return back();
    }

    public function leftover(Request $request)
    {
        $leftOver = DB::table('products')
            ->where('status', 'active')
            ->whereNull('deleted_at')
            ->join('warehouse_products', function ($join) {
                $join->on('products.id', '=', 'warehouse_products.product_id');
            })
            ->join('warehouses', function ($join) {
                $join->on('warehouses.id', '=', 'warehouse_products.warehouse_id');
            })
            ->select('products.*', 'products.id as item_id', 'warehouses.id as warehouses_id','warehouses.name as warehouse_name', 'warehouse_products.left_count as product_left_count');

        $leftOver = $this->sort($leftOver, $request);
        $leftOver = $this->filter($leftOver, $request);

        $leftOver = $leftOver->paginate(25);
        $session = session()->get('message');
        $error = session()->get('error');

        $data = [
            'item_id' => '#',
            'name' => 'Наименование продукта',
            'product_left_count' => 'Остаток на складе',
            'warehouse_name' => 'Склад',
            'created_at' => 'Дата создания'
        ];

        return view('admin.leftOver', compact('leftOver', 'session', 'error', 'data'));
    }

    public function updateLeftOver(Request $request)
    {
        $data = $request->all();


        $product = WarehouseProduct::where('product_id', $request->leftover_id)->where('warehouse_id', $request->warehouseid)->firstOrFail();
        $product->left_count = $request->value;
        $product->save();

        session()->flash('message', 'Вы успешно изменили остатки на складе');

        return back();
    }

    public function storeWarehouse(Request $request)
    {
        Warehouse::create([
            'marketplace_type_id' => $request->marketplace_type_id,
            'name' => $request->name
        ]);

        session()->flash('message', 'Вы успешно создали склад');

        return back();
    }

    public function deleteWarehouse(Request $request)
    {
        $leftOver = Warehouse::where('id', $request->delete_id)->firstOrFail();

        if (WarehouseProduct::query()->where('warehouse_id', $request->delete_id)->exists()) {
            session()->flash('error', 'Вы не можете удалить склад, в нем лежат продукты');
            return back();
        }

        $leftOver->delete();
        session()->flash('message', 'Вы успешно удалили склад');

        return back();
    }

    public function deleteMarketplace(Request $request)
    {
        $leftOver = MarketplaceType::where('id', $request->delete_id)->firstOrFail();

        if (Warehouse::query()->where('marketplace_type_id', $leftOver->id)->exists()) {
            session()->flash('error', 'Вы не можете удалить маркетплэйс, к нему привязаны склады');
            return back();
        }

        $leftOver->delete();
        session()->flash('message', 'Вы успешно удалили маркетплэйс');

        return back();
    }

    public function updateWarehouse(Request $request)
    {
        $leftOver = Warehouse::where('id', $request->id)->firstOrFail();
        $leftOver->name = $request->name;
        $leftOver->marketplace_type_id = $request->marketplace_type_id;
        $leftOver->save();

        session()->flash('message', 'Вы успешно изменили склад');

        return back();
    }

    public function warehouses(Request $request)
    {
        $warehouses = Warehouse::query()
            ->leftJoin('marketplace_types', 'warehouses.marketplace_type_id', '=', 'marketplace_types.id')
            ->leftJoin('warehouse_products', 'warehouse_products.warehouse_id', '=', 'warehouses.id')
            ->select('warehouses.*', DB::raw('marketplace_types.name as marketplace_name'), DB::raw('COUNT(warehouse_products.id) as count_products'))
            ->groupBy('warehouses.id');


        $warehouses = $this->sort($warehouses, $request);
        $warehouses = $this->filter($warehouses, $request);

        $warehouses = $warehouses->paginate(25);
        $session = session()->get('message');
        $error = session()->get('error');

        $data = [
            'id' => '#',
            'name' => 'Название склада',
            'marketplace_name' => 'Маркетплэйс',
            'count_products' => 'Количество продуктов',
            'created_at' => 'Дата создания',
        ];

        return view('admin.warehouses', compact('warehouses', 'session', 'data', 'error'));
    }

    public function marketplaces(Request $request)
    {
        $marketplaces = MarketplaceType::query();

        $marketplaces = $this->sort($marketplaces, $request);
        $marketplaces = $this->filter($marketplaces, $request);

        $marketplaces = $marketplaces->paginate(25);

        $session = session()->get('message');
        $error = session()->get('error');

        $data = [
            'id' => '#',
            'name' => 'Название',
            'status' => 'Статус',
            'created_at' => 'Дата создания'
        ];

        return view('admin.marketplaces', compact('session', 'error', 'marketplaces', 'data'));
    }

    public function storeMarketplace(Request $request)
    {
        $marketPlace = MarketplaceType::create([
            'status' => MarketplaceType::ACTIVE,
            'name' => $request->name
        ]);
        session()->flash('message', 'Вы успешно создали маркетплэйс');

        return back();
    }

    public function updateMarketplace(Request $request)
    {
        $type = MarketplaceType::where('id', $request->token_id)->firstOrFail();
        $type->status = $request->status;
        $type->save();
        session()->flash('message', 'Вы успешно изменили статус маркетплэйса');

        return back();
    }
}
