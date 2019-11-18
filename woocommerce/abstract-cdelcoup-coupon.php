<?php

abstract class Coupon
{
    protected $coupon_code;
    
    protected function hasCouponCode()
    {
        return $this->getCart()->has_discount($this->coupon_code);
    }
    
    protected function getCartItems()
    {
        return $this->getCart()->get_cart();
    }
    
    protected function getCart()
    {
        return WC()->cart;
    }
    
    protected function addCoupon()
    {
        $this->getCart()->add_discount($this->coupon_code);
    }
    
    
    abstract public function register();
}
