<?php

namespace Database\Seeders;

use App\Models\MarketplaceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mak = new MarketplaceType();
        $mak->name = 'Wildberries';
        $mak->status = MarketplaceType::ACTIVE;
        $mak->save();

        $mak = new MarketplaceType();
        $mak->name = 'OZON';
        $mak->status = MarketplaceType::CLOSED;
        $mak->save();
    }
}
