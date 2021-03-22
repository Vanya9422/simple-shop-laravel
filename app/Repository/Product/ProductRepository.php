<?php

namespace App\Repository\Product;

use App\Models\Product as Model;
use App\Repository\CoreRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProductRepository
 * @package App\Repository\Product
 */
class ProductRepository extends CoreRepository
{

    /**
     * @var int
     */
    private $paginateLength = 20;

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
    public function randomPaginateAll()
    {
        $columns = ['id', 'name'];
        return $this->startConditions()
            ->active()
            ->activeCategory($columns)
            ->with(['generalImage' => function ($q) {
                $q->select('id', 'url', 'imageable_id');
            }])
            ->inRandomOrder()->paginate($this->paginateLength);
    }

    /**
     * @return mixed
     */
    public function showOwnProducts()
    {
        return $this->startConditions()
            ->where('user_id', auth()->id())
            ->with([
                'category' => function ($q) {
                    $q->select('id', 'name');
                },
                'generalImage' => function ($q) {
                    $q->select('id', 'url', 'imageable_id');
                },
            ])->orderByDesc('updated_at')->get();
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getProductBySlug(string $slug)
    {
        return $this->startConditions()
            ->where('user_id', auth()->id())
            ->where('slug', $slug)
            ->with([
                'category' => function ($q) {
                    $q->select('id', 'name');
                },
                'images' => function ($q) {
                    $q->select('id', 'url', 'imageable_id', 'is_primary');
                },
            ])->first();
    }
}
