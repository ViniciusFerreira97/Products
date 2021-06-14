<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'tb_client';
    protected $primaryKey = 'id_client';
    public $timestamps = false;

    protected $fillable = [
        'nm_client'
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'id_client');
    }
}
