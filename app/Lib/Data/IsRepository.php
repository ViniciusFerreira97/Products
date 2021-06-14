<?php

namespace App\Lib\Data;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IsRepository
{
    public function all(array $options = []): Collection;

    public function byId(int $id): Model;

    public function create(array $data);

    public function delete(Model $model): bool;

    public function update(Model $model, array $data): Model;
}
