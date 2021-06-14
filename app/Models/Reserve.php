<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserve extends Model
{
    use HasFactory;

    protected $table = 'tb_reserve';
    protected $primaryKey = 'id_reserve';
    protected $appends = ['sku_product'];
    public $timestamps = false;

    protected $fillable = [
        'id_product',
        'quantity_reserve'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
    
    public function getSkuProductAttribute()
    {
        return $this->product()->first()->sku_product;
    }
}
