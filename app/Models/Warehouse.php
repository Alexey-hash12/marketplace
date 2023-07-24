<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketplace_type_id',
        'name'
    ];

    public function marketplace()
    {
        return $this->belongsTo(MarketplaceType::class, 'marketplace_type_id');
    }
}
