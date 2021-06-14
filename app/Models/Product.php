<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'tb_product';
    protected $primaryKey = 'id_product';
    protected $appends = ['nm_client'];
    public $timestamps = false;

    protected $fillable = [
        'id_client',
        'sku_product',
        'quantity_product'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function reserve():  HasMany
    {
        return $this->hasMany(Reserve::class, 'id_product');
    }

    public function getNmClientAttribute()
    {
        return $this->client()->first()->nm_client;
    }
}
