<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketplaceType extends Model
{
    use HasFactory, SoftDeletes;

    const ACTIVE = 'ACTIVE';
    const CLOSED = 'CLOSED';

    protected $fillable = [
        'name',
        'status'
    ];
}
