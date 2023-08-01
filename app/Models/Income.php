<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketplace_id',
        'period',
        'days',
        'min_stocs',
        'on_the_way',
        'box_qr',
        'count_articles'
    ];

    public function marketplace()
    {
        return $this->belongsTo(MarketplaceType::class, 'marketplace_id');
    }
}
