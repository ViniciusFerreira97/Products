<?php


namespace App\Repository;

use App\Lib\Data\DatabaseRepository;
use App\Models\Product;
use App\Models\Reserve;
use App\Repository\ProductRepository;


class ReserveRepository extends DatabaseRepository
{

    protected array $filterFields = ['id_reserve'];

    public function __construct(Reserve $model)
    {
        $this->model = $model;
    }

    public function creating($model, $data)
    {
        $product = new ProductRepository(new Product);
        $updateProduct = $product->updateQuantityCreateReserve($data);

        if(!$updateProduct) return false;

        return $model;
    }

    public function deleted($deleted)
    {
        $product = new ProductRepository(new Product);
        $product->updateQuantityDeleteReserve($deleted);

        return true;
    }

}