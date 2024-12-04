<?php
require_once 'Model/ModelAdminFournisseur.php';

class ControllerAdminFournisseur {
    private $model;

    public function __construct() {
        $this->model = new ModelAdminFournisseur();
    }

    
    public function viewAdminFournisseur() {
        $fournisseurs = $this->model->getFournisseur(); 
        require 'View/vuAdminFournisseur.php';
    }
    
    public function deleteFournisseur(){
        $id=$_POST['id'];
        $fournisseurs = $this->model->deleteFournisseur($id); 
        header(header: 'Location: index.php?action=adminFournisseur');
        exit;
    }

    public function addFournisseur(){
        $nom = $_POST['nom'];
        $produit = $_POST['produit'];
        $quantite = $_POST['quantité'];
        $uniteMesure = $_POST['unitéMesure'];

        // Appel au modèle pour insérer dans la base de données
        $fournisseurs = $this->model->addFournisseur($nom, $produit, $quantite, $uniteMesure);

        // Redirection après traitement
        header('Location: index.php?action=adminFournisseur');
        exit;
    }

    public function findFournisseur(){
        $search=$_POST['search'] ?? '';

        $fournisseurs = $this->model->findFournisseur($search ); 
        require 'View/vuAdminFournisseur.php';

    }
}

?>