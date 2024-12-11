<?php
require_once 'Model/ModelAdminProduit.php';

class ControllerAdminProduit {
    private $model;

    public function __construct() {
        $this->model = new ModelAdminProduit();
    }

    
    public function viewAdminproduit() {
        $produits = $this->model->getProduits(); 
        $stock = $this->model->getStock(); 
        require 'View/vuAdminProduit.php';
    }
    
    public function deleteProduit(){
        $id=$_POST['id'];
        $produits = $this->model->deleteProduit($id); 
        header(header: 'Location: index.php?action=adminProduit');
        exit;
    }
    
    public function addProduit(){
        $reference=$_POST['reference'];
        $description=$_POST['description'];
        $prixPublic=$_POST['prix_public'];
        $prixAchat=$_POST['prix_achat'];
        $image=$_POST['image'];
        $icone=$_POST['icone'];
        $titre=$_POST['titre'];
        $descriptif=$_POST['descriptif'];
        $seuil=$_POST['seuil'];
        $quantite=$_POST['quantité'];  
        $produits = $this->model->addProduit($reference,$description,$prixPublic,$prixAchat,$image,$icone,$titre,$descriptif); 

        $this->model->addStock($seuil,$quantite);
        header(header: 'Location: index.php?action=adminProduit');
        exit;
    }

    public function findProduit(){
        $search=$_POST['search'] ?? '';

        $produits = $this->model->findProduit($search ); 
        $stock = $this->model->getStock(); 

        require 'View/vuAdminProduit.php';

    }
}

?>