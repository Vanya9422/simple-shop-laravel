<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\User;
use App\Repository\Order\OrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerOrderController extends Controller
{
    /**
     * @var $orderRepository
     */
    private $orderRepository;

    /**
     * CustomerOrderController constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = $request->withRegistration
                ? (new User())->create($request->objectUser)->assignRole('customer')
                : \auth()->user();

            if (Auth::guard()) Auth::guard()->login($user);

            $this->authorize('add order');

            $user->orders()->create($request->objectOrder);

            DB::commit();
            return new JsonResponse([
                'code' => 201,
                'message' => 'Order Successfully Created !'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return new JsonResponse([
                'code'      =>  404,
                'message'   =>  $e->getMessage()
            ], 401);
        }
    }
}
