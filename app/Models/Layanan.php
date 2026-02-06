<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'desk' => 'array',
    ];
}
