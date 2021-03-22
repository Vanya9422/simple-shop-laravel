<?php

namespace App\Http\Controllers;

use App\Repository\Product\ProductRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductRepository $productRepository
     * @return Factory|View
     */
    public function index(ProductRepository $productRepository)
    {
        return view('products', [
            'products' => $productRepository->randomPaginateAll()
        ]);
    }
}
