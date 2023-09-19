<?php

namespace App\Service\Marketplace;

use App\Models\Token;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Wildberries
{
    public function parse()
    {
        $log = Log::build([
            'driver' => 'daily',
            'path' => storage_path('logs/schedule/wild/wild.log')
        ]);

        $log->info('Parse Wildberries..');

        $url = 'https://statistics-api.wildberries.ru/api/v1/supplier/stocks';
        $dateFrom = '2020-01-01';

        $token = Token::where('marketplace_id', 1)->where('type', 'statistic')->first();

        $headers = [
            'Authorization: ' . $token->value
        ];

        $queryParams = [
            'dateFrom' => $dateFrom
        ];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url . '?' . http_build_query($queryParams));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
        } else {
            $data = json_decode($response, true);
            if ($data && count($data)) {
                return $data;
            }
        }
        return null;
    }

    public function parseV2()
    {
        $url = 'https://suppliers-api.wildberries.ru/content/v1/cards/cursor/list';
        $authorization = 'Authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhY2Nlc3NJRCI6IjJhZjU4NmNmLThiYTQtNDIyYy05ZjIwLWQ1MDgzZDE4Y2RhNyJ9.D6oaVvwuW6KPho1tBMlPfToMU4Sh8lM9tdY4PtRVJCQ';

        $data = [
            'sort' => [
                'cursor' => [
                    'limit' => 1000
                ],
                'filter' => [
                    'withPhoto' => -1
                ]
            ]
        ];

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                $authorization
            ],
            CURLOPT_POSTFIELDS => json_encode($data)
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        $data = Arr::get($data, 'data');
        if ($data) {
            return $data;
        }

        return null;
    }

    public function parseOrders()
    {
        $url = 'https://statistics-api.wildberries.ru/api/v1/supplier/orders';
        $dateFrom = now()->subMonth()->format('Y-m-d');
        $token = Token::where('marketplace_id', 1)->where('type', 'statistic')->first();

        $headers = [
            'Authorization: ' . $token->value
        ];

        $queryParams = [
            'dateFrom' => $dateFrom
        ];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url . '?' . http_build_query($queryParams));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
        } else {
            $data = json_decode($response, true);
            if ($data && count($data)) {
                return $data;
            }
        }
        return null;
    }

    public function parseSales()
    {
        $url = 'https://statistics-api.wildberries.ru/api/v1/supplier/sales';
        $dateFrom = now()->subMonth()->format('Y-m-d');
        $token = Token::where('marketplace_id', 1)->where('type', 'statistic')->first();

        $headers = [
            'Authorization: ' . $token->value
        ];

        $queryParams = [
            'dateFrom' => $dateFrom
        ];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url . '?' . http_build_query($queryParams));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
        } else {
            $data = json_decode($response, true);
            if ($data && count($data)) {
                return $data;
            }
        }
        return null;
    }
}
