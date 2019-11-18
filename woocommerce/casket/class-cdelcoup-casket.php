<?php

class Cdelcoup_Casket extends Coupon
{
    protected static $casket_id = 7089;
    protected static $categories_exclusion = [
        516, 650, 655, 767, 734
    ];
    
    protected $coupon_code = 'kistje';
    
    
    protected $has_casket = false;
    protected $has_wine = false;
    
    public function register(): void
    {
        if ($this->hasCouponCode()) {
            return;
        }

        foreach ($this->getCartItems() as $cartItemKey => $cartItem) {
            if ($this->hasCasketItem($cartItem)) {
                $this->has_casket = true;
                break;
            }
        }
        
        if (!$this->has_casket) {
            return;
        }
        
        foreach ($this->getCartItems() as $cartItemKey => $cartItem) {
            /** @var WC_Product $product */
            $product = $cartItem['data'];
            $categories = $product->get_category_ids();
            array_map(function ($category) {
                if (!in_array($category, static::$categories_exclusion)) {
                    $this->has_wine = true;
                }
            }, $categories);
            
            if ($this->has_wine) {
                break;
            }
        }
        
        if ($this->has_wine && $this->has_casket) {
            $this->addCoupon();
        }
    }
    
    protected function hasCasketItem($cartItem)
    {
        return $cartItem['product_id'] === static::$casket_id;
    }
}
