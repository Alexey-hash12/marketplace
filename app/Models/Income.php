<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    public function marketplace()
    {
        return $this->belongsTo(MarketplaceType::class, 'marketplace_id');
    }
}
