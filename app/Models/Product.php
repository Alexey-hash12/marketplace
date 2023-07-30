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

    public static array $colors = [
        ['id' => 'red', 'label' => 'Красный', 'style' => 'red'],
        ['id' => 'green', 'label' => 'Зеленый', 'style' => 'green'],
        ['id' => 'blue', 'label' => 'Синий', 'style' => 'blue']
    ];

    public static  array $sizes = [
        ['id' => '1', 'label' => '1 кв2'],
        ['id' => '2', 'label' => '2 кв2']
    ];

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products', 'product_id', 'warehouse_id');
    }
}
