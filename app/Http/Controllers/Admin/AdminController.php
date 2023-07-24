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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $products = Product::query()->with('marketplace');

        $products = $products->paginate(25);

        $session = session()->get('message');

        return view('admin.products', compact('products', 'session'));
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

        return view('admin.incomes', compact('incomes', 'session'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function users(Request $request)
    {
        $users = User::query();
        $users = $users->paginate(25);
        $session = session()->get('message');

        return view('admin.users', compact('users', 'session'));
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

        return view('admin.tokens', compact('tokens', 'session'));
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
        $leftOver = Leftover::query()->join('products', 'leftovers.product_id', '=', 'products.id')
        ->join('warehouses', 'leftovers.warehouse_id', '=', 'warehouses.id')->select('leftovers.*', DB::raw('products.name as product_name'), DB::raw('warehouses.name as warehouse_nam'));

        $leftOver = $this->sort($leftOver, $request);
        $leftOver = $this->filter($leftOver, $request);

        $leftOver = $leftOver->paginate(25);
        $session = session()->get('message');

        return view('admin.leftOver', compact('leftOver', 'session'));
    }

    public function deleteLeftOver(Request $request)
    {
        $leftOver = Leftover::where('id', $request->delete_id)->firstOrFail();
        $leftOver->delete();
        session()->flash('message', 'Вы успешно удалили остаток');

        return back();
    }

    public function storeWarehouse(Request $request)
    {

    }

    public function warehouses(Request $request)
    {
        $warehouses = Warehouse::query()->join('marketplace_types', 'warehouses.marketplace_type_id', '=', 'marketplace_types.id')
        ->join('warehouse_products', 'warehouse_products.warehouse_id', '=', 'warehouses.id')
        ->select('warehouses.*', DB::raw('marketplace_types.name as marketplace_name'), DB::raw('COUNT(warehouse_products) as count_products'));

        $warehouses = $this->sort($warehouses, $request);
        $warehouses = $this->filter($warehouses, $request);

        $warehouses = $warehouses->paginate(25);
        $session = session()->get('message');

        $data = [
            'id' => '#',
            'name' => 'Название склада',
            'marketplace_name' => 'Маркетплэйс',
            'created_at' => 'Дата создания'
        ];

        return view('admin.warehouses', compact('warehouses', 'session', 'data'));
    }
}
