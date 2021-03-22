<?php

namespace App\Repository;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 * @package App\Repository
 */
abstract class CoreRepository
{
    /**
     * @var Model $model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Application|Model|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
