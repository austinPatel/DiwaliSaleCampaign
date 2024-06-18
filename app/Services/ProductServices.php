<?php
namespace App\Services;

use Exception;

class ProductServices
{
    public function buyProduct(array $products){

        try{
            
            // $totalProducts= count($products);
            // $maxDiscountProduct = floor($totalProducts/2);
    
            rsort($products); // Reverse the Product array for arranging discount and payable item
            $discountedItems = [];
            $payableItems = [];
            $i = 0;
            // Process the products to determine discounted and payable items
            while ($i < count($products)) {
                $payableItems[] = $products[$i];
                $j = $i + 1;
                
                // Find the next eligible discounted product
                while ($j < count($products) && $products[$j] >= $products[$i]) {
                    $j++;
                }
                
                if ($j < count($products) && $products[$j] < $products[$i]) {
                    $discountedItems[] = $products[$j];
                    array_splice($products, $j, 1);  // Remove the discounted item from the list
                }
                
                // next product in the list
                $i++;
            }
            $response=[
                'discountedItems' => $discountedItems,
                'payableItems' => $payableItems
            ];
            return $response;
    
        }catch(Exception $error){
            throw new Exception("Something is wrong",400);
        }
    }
}