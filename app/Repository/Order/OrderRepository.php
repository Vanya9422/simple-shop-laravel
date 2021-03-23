<?php

namespace App\Repository\Order;

use App\Models\Order as Model;
use App\Repository\CoreRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Builder[]|Collection
     */
    public function showOwnOrders()
    {
        return $this->startConditions()
            ->select('id', 'product_id', 'customer_id', 'quantity', 'is_confirmed', 'is_approved', 'created_at', 'updated_at')
            ->with(['product' => function ($q) {
                $q->select('id', 'name');
            }])->where('customer_id', auth()->id())->orderByDesc('updated_at')->get();
    }

}
