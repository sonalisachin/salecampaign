<?php

// app/Services/OrderService.php

namespace App\Services;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
class OrderService
{
    public function RuleFirst($products)
    {
    	$productsData = explode(",",$products);

    	$quantity = 1;
    	$customerId = 1;
    	$orderItem = $freeOrderItem = array();
    	foreach ($productsData as $key => $value) { 
    		$product = Product::findOrFail($value);
    		//print_r($product);
    		if(isset($product))
    		{
    			if ($product->price > 0) {
	            $orderItem[] = $value;
	            // Check if the customer is eligible for the free product
		            $freeProduct = Product::where('price', '<=', $product->price)
		            						->orWhere('price', '=', $product->price)
		                                  	->where('id', '!=', $product->id)
		                                  	->first();
		            if ($freeProduct) {	               
		            	$freeOrderItem[] = $freeProduct->id;	                
		            }
		        }
    		}
    		else
    		{
    			return response()->json([
	                'success' => false,
	                'message' => 'No Match product found.',
            	], 400);
    		}
    	}
    	
    	if(isset($orderItem) && isset($freeOrderItem))
    	{
    		return response()->json([
	                'success' => true,
	                'paidProducts' => $orderItem,
	                'freeProducts' => $freeOrderItem,
	        ]);
    	}
    	else
    	{
    		return response()->json([
                'success' => false,
                'message' => 'No Match product found.',
            ], 400);
    	}
    }

    public function RuleTwo($products)
    {
    	$productsData = explode(",",$products);
    	$quantity = 2;
    	$customerId = 1;
    	$orderItem = $freeOrderItem = array();
    	foreach ($productsData as $key => $value) { 
    		$product = Product::findOrFail($value);
    		if(isset($product))
    		{
    			if ($product->price > 0) {
	            $orderItem[] = $value;
	            // Check if the customer is eligible for the free product
		            $freeProduct = Product::where('price', '<=', $product->price)
		                                  	->where('id', '!=', $product->id)
		                                  	->first();
		            if ($freeProduct) {	               
		            	$freeOrderItem[] = $freeProduct->id;	                
		            }
		        }
    		}
    		else
    		{
    			return response()->json([
	                'success' => false,
	                'message' => 'No Match product found.',
            	], 400);
    		}
    	}
    	
    	if(isset($orderItem) && isset($freeOrderItem))
    	{
    		return response()->json([
	                'success' => true,
	                'paidProducts' => $orderItem,
	                'freeProducts' => $freeOrderItem,
	        ]);
    	}
    	else
    	{
    		return response()->json([
                'success' => false,
                'message' => 'No Match product found.',
            ], 400);
    	}
    }
    
    public function ruleThree($products)
    {
    	$customerId = 1;
    	$productsData = explode(",",$products);
    	$productCnt = count($productsData);
    	$paidProductsCnt = round($productCnt/2);
    	if (count($productsData) < 4) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough products to apply the promotion.',
            ], 400);
        }
        else
        {
        	$products = Product::whereIn('id', $productsData)->get(array('id','price'))->toArray();
        	usort($products, function($a, $b) {
            	return $b['price'] <=> $a['price'];
        	});

        	// Paid products
	        $paidProducts = array_slice($products, 0, $paidProductsCnt);	        
	        // Free products
	        $freeProducts = array_slice($products, $paidProductsCnt, $productCnt);
	        // Check if the free products' prices are less than the first paid product's price
	        if ($freeProducts[0]['price'] < $paidProducts[0]['price'] && $freeProducts[1]['price'] < $paidProducts[0]['price']) {
	            return response()->json([
	                'success' => true,
	                'paidProducts' => $paidProducts,
	                'freeProducts' => $freeProducts,
	            ]);
	        } else {
	            return response()->json([
	                'success' => false,
	                'message' => 'The selected products do not meet the promotion criteria.',
	            ], 400);
	        }
            
        }
    }
}
