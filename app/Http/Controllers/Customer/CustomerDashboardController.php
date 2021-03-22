<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repository\Order\OrderRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CustomerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param OrderRepository $orderRepository
     * @return Factory|View
     */
    public function index(OrderRepository $orderRepository)
    {
        return view('customer.dashboard', [
            'orders' => $orderRepository->showOwnOrders()
        ]);
    }
}
