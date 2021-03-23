<?php

namespace App\Repository\User;

use App\Repository\CoreRepository;

class UserRepository extends CoreRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return \App\Models\User::class;
    }

    /**
     * @return mixed
     */
    public function getOwnOrders()
    {
        return \auth()->user()->orderProducts()->with([
            'product' => function ($q) {
                $q->select('id', 'name');
            },
        ])->get();
    }
}
