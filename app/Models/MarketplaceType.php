<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceType extends Model
{
    use HasFactory;

    const ACTIVE = 'ACTIVE';
    const CLOSED = 'CLOSED';
}
