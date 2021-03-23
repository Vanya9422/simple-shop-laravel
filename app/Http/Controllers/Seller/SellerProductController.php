<?php

namespace App\Http\Controllers\Seller;

use App\Events\OrderConfirmedBySeller;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Repository\Category\CategoryRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\User\UserRepository;
use Flasher\Prime\FlasherInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SellerProductController
 * @package App\Http\Controllers
 */
class SellerProductController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ProductRepository
     */
    private $userRepository;

    /**
     * SellerProductController constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param UserRepository $userRepository
     */
    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ProductRepository $productRepository
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function index(ProductRepository $productRepository)
    {
        $this->authorize('show own products');
        return view('seller.product-list', [
            'products' => $productRepository->showOwnProducts()
        ]);
    }

    /**
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('add product');
        return \view('seller.create-product', [
            'categories' => $this->categoryRepository->show()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(string $slug)
    {
        $product = $this->productRepository->getProductBySlug($slug);
        $this->authorize('update', $product);
        return \view('seller.edit-product', [
            'product' => $product,
            'categories' => $this->categoryRepository->show()
        ]);
    }

    /**
     * @param ProductRequest $request
     * @param FlasherInterface $flasher
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(ProductRequest $request, FlasherInterface $flasher, Product $product)
    {
        DB::beginTransaction();
        try {
            $makeDataProduct = $this->unsetReqParamKeys($request);
            $productData = $request->except(['general_image', 'multiple_image']);
            $productData['user_id'] = auth()->id();
            $product->create($productData)->uploadFile($makeDataProduct);
            DB::commit();
            $flasher->addSuccess('Your Product Successfully Created');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $flasher->addError(ERRMESS);
            return back();
        }
    }

    /**
     * @param ProductRequest $request
     * @param FlasherInterface $flasher
     * @param Product $product
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(ProductRequest $request, FlasherInterface $flasher, Product $product)
    {
        $this->authorize('update', $product);
        DB::beginTransaction();
        try {
            $makeDataProduct = $this->unsetReqParamKeys($request);
            $request->except(['general_image', 'multiple_image']);
            $product->update($request->all());
            $product->uploadFile($makeDataProduct);
            DB::commit();
            $flasher->addSuccess('Your Product Successfully Updated');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $flasher->addError(ERRMESS);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        try {
            $product->delete();
            return new JsonResponse([
                'code' => 201,
                'message' => 'Product Successfully deleted !'
            ], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return new JsonResponse(['code' => 404, 'message' => ERRMESS], 401);
        }
    }

    /**
     * @param Image $image
     * @return JsonResponse
     */
    public function deleteImage(Image $image)
    {
        try {
            $this->authorize('delete-image', $image);
            $image->delete();
            return new JsonResponse([
                'code' => 201,
                'message' => 'Image Successfully deleted !'
            ], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return new JsonResponse(['code' => 404, 'message' => ERRMESS], 401);
        }
    }

    /**
     * @return Factory|View
     */
    public function orderList()
    {
        return \view('seller.order-list', [
            'orders' => $this->userRepository->getOwnOrders()
        ]);
    }


    /**
     * @param Order $order
     * @return JsonResponse
     */
    public function confirmOrder(Order $order)
    {
        try {
            DB::beginTransaction();
            $this->authorize('confirm', $order);
            $order->update(['is_confirmed' => 1]);
            event(new OrderConfirmedBySeller(auth()->user(), $order));
            DB::commit();
            return new JsonResponse([
                'code' => 201,
                'message' => 'Order Successfully confirmed !'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return new JsonResponse(['code' => 404, 'message' => ERRMESS], 401);
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function unsetReqParamKeys($request)
    {
        $multiple = $request->file('multiple_image');
        $multiple['general'] = $request->file('general_image');
        return $multiple;
    }
}
