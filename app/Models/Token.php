<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'marketplace_id',
        'type',
        'value'
    ];

    public function marketplace()
    {
        return $this->belongsTo(MarketplaceType::class, 'marketplace_id');
    }
}
