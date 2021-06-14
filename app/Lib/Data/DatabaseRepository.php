<?php

namespace App\Lib\Data;

use App\Lib\Data\IsRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Base repository using database.
 */
class DatabaseRepository implements IsRepository
{
    protected Model $model;

    public function all(array $options = []): Collection
    {
        $query = $this->model->newQuery();

        return $query->get();
    }

    public function byId(int $id): Model
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data)
    {
        $model = $this->model->newInstance($data);

        if (method_exists($this, 'creating')) {
            $model = call_user_func([$this, 'creating'], $model, $data);
        }

        if(!$model) return false;

        $saved = $model->save();

        if (!$saved) {
            throw new Exception('Error creating model on database.');
        }

        return $model;
    }

    public function delete(Model $model): bool
    {
        $data = $model;
        $deleted = $model->delete();

        if (!$deleted) {
            throw new Exception('Error deleting model on database.');
        }

        if (method_exists($this, 'deleted')) {
            $model = call_user_func([$this, 'deleted'], $data);
        }

        return $deleted;
    }

    public function update(Model $model, array $data): Model
    {
        $model->fill($data);

        if (method_exists($this, 'updating')) {
            $model = call_user_func([$this, 'updating'], $model, $data);
        }

        $saved = $model->save();

        if (!$saved) {
            throw new Exception('Error updating model on database.');
        }
        return $model;
    }

    public function import(array $data): Model
    {
        $model = $this->model->newInstance($data);

        if (method_exists($this, 'importing')) {
            $model = call_user_func([$this, 'importing'], $model, $data);
        }

        $saved = $model->save();

        if (!$saved) {
            throw new Exception('Error creating model on database.');
        }

        return $model;
    }
}
