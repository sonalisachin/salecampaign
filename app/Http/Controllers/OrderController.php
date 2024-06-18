<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\OrderService;

class OrderController extends Controller
{
    protected $OrderService;

    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }

    public function ruleFirst(Request $request)
    {
       
        $products = $request->input('products'); // array of product_id => quantity
        $order = $this->OrderService->RuleFirst($products);
        return $order;
    }
    public function ruleSecond(Request $request)
    {
        $products = $request->input('products'); // array of product_id => quantity
        $order = $this->OrderService->RuleTwo($products);
        return $order;
    }
    public function ruleThree(Request $request)
    {
        $products = $request->input('products'); // array of product_id => quantity
        $order = $this->OrderService->RuleThree($products);
        return $order;
    }
}
