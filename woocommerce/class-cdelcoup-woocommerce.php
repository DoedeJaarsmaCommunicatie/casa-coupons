<?php

class Cdelcoup_Woocommerce
{
    private $plugin_name;
    
    private $version;
    
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        
        $this->version = $version;
    }
    
    public function addCasketCoupon()
    {
        $this->inlcudes();
        $coupon_plugin = new Cdelcoup_Casket();
        add_action('woocommerce_before_cart', [$coupon_plugin, 'register']);
    }
    
    protected function inlcudes()
    {
        require_once __DIR__ . '/abstract-cdelcoup-coupon.php';
        
        require_once __DIR__ . '/casket/class-cdelcoup-casket.php';
    }
}
