<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const TYPE_BOX = 'TYPE_BOX';

    const TYPE_MONOPALLET = 'TYPE_MONOPALLET';

    const TYPE_SUPER_SAFE = 'TYPE_SUPER_SAFE';
}
