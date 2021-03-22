<?php

namespace App\Repository\Category;

use App\Models\Category as Model;
use App\Repository\CoreRepository;

class CategoryRepository extends CoreRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return mixed
     */
    public function show()
    {
        return $this->startConditions()
            ->select('id', 'name')
            ->toBase()
            ->get();
    }
}
