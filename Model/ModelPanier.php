<?php
class ModelPanier {
    private $cart;

    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->cart = &$_SESSION['cart'];
    }

    public function addToCart($productId) {
        
    }

    public function getCart() {
        return $this->cart;
    }
}