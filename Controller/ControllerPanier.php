<?php
require_once 'Model/ModelPanier.php';

class ControllerPanier {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new ModelPanier();
    }

    public function addToCart() {
        
    }

    public function viewCart() {
        $panier = $this->cartModel->getCart();
        require 'View/vuPanier.php';
    }
}