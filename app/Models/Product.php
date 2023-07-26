<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_BOX = 'TYPE_BOX';

    const TYPE_MONOPALLET = 'TYPE_MONOPALLET';

    const TYPE_SUPER_SAFE = 'TYPE_SUPER_SAFE';

    protected $fillable = [
        'instance_id',
        'marketplace_type_id',
        'name',
        'sku',
        'price',
        'sizes',
        'colors',
        'files',
        'income_type'
    ];

    protected $casts = [
        'sizes' => 'array',
        'files' => 'array',
        'colors' => 'array'
    ];

    public function marketplace()
    {
        return $this->belongsTo(MarketplaceType::class, 'marketplace_type_id');
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products', 'warehouse_id', 'product_id');
    }
}
