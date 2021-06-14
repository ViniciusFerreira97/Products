<?php


namespace App\Repository;

use App\Lib\Data\DatabaseRepository;

use App\Models\Client;


class ClientRepository extends DatabaseRepository
{

    protected array $filterFields = ['id_client'];

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    public function getByName($nm_client)
    {
        return $this->model->where('nm_client', $nm_client)->first();
    }

}