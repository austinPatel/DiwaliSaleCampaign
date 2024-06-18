<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepository;
use App\Services\ProductServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends ApiController
{
    protected $productRepository;
    protected $productServices;

    public function __construct(ProductRepository $productRepository, ProductServices $productServices){
        $this->productRepository = $productRepository;
        $this->productServices = $productServices;
    }
    public function buyProduct(Request $request)
    {
        try{
            $products = $request->input('products');
            if (!is_array($products) || empty($products)) {
                return $this->sendError("Invalid Input",400);
            }
            $response = $this->productServices->buyProduct($products);
            return $this->sendResponse($response,"Success");
                    
        }catch(Exception $error){
            return $this->sendError("Something is wrong",400);
        }


    }
}
