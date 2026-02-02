<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function layanan() {
        return $this->belongsTo(layanan::class, 'id_layanan');
    }

    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
