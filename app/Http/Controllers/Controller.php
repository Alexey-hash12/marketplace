<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function filter($products, $request)
    {
        foreach ($request->all() as $key => $requestField) {
            if (!$requestField) {
                continue;
            }
            $requestData = explode('-', $key);
            if (count($requestData) > 1) {
                if ($requestData[1] == 'search') {
                    $products->where($requestData[0], 'like', "%$requestField%");
                } else if ($requestData[1] == 'in') {
                    $products->where($requestData[0], '=', "$requestField");
                } else if ($requestData[1] == 'from') {
                    $products->having($requestData[0], '>=', $requestField);
                } else if ($requestData[1] == 'to') {
                    $products->having($requestData[0], '<=',  $requestField);
                }
            }
        }


        if ($request->get('filter_name') && $request->get('filter_value')) {
            $products->where($request->get('filter_name'), 'like', "%{$request->get('filter_value')}%");
        }

        if ($request->get('budget_from')) {
            $products->where($request->get('budget_from'), '>=', 'BUDGET');
        }

        return $products;
    }

    public function sort($products, $request)
    {
        if ($request->get('sort_type') && $request->get('sort_value')) {
            $products->orderBy($request->get('sort_type'), $request->get('sort_value'));
        } else {
            $products->orderByDesc('updated_at');
        }

        return $products;
    }

}
