<?php


namespace App\Repository;

use App\Lib\Data\DatabaseRepository;
use App\Models\Client;
use App\Models\Product;
use App\Repository\ClientRepository;


class ProductRepository extends DatabaseRepository
{

    protected array $filterFields = ['id_product'];

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function importing($model, $data)
    {
        $client = new ClientRepository(new Client);

        $model->id_client = $client->getByName($data['id_client'])->id_client;

        return $model;
    }

    public function updateQuantityCreateReserve($data)
    {
        $getProduct = $this->byId($data['id_product']);

        if ($getProduct->quantity_product < $data['quantity_reserve']) return false;

        $newQuantity = $getProduct->quantity_product - $data['quantity_reserve'];

        $this->update($getProduct, ['quantity_product'=> $newQuantity]);

        return true;
    }

    public function updateQuantityDeleteReserve($data)
    {
        $getProduct = $this->byId($data->id_product);
        $newQuantity = $getProduct->quantity_product + $data->quantity_reserve;

        $this->update($getProduct, ['quantity_product'=> $newQuantity]);

        return true;
    }

}