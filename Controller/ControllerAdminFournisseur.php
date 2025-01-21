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
        $id_cookie = $_POST['id_cookie'];
        $quantite = $_POST['quantité'];

        // Appel au modèle pour insérer dans la base de données
        $fournisseurs = $this->model->addFournisseur($nom, $id_cookie, $quantite);
        $this->modifierProduit($id_cookie,$quantite);
        // Redirection après traitement
        header('Location: index.php?action=adminFournisseur');
        exit;
    }

    public function findFournisseur(){
        $search=$_POST['search'] ?? '';

        $fournisseurs = $this->model->findFournisseur($search ); 
        require 'View/vuAdminFournisseur.php';

    }

    public function modifierProduit($id_cookie,$qtt){
        $id=$id_cookie;
        $quantite=$qtt;
        $this->model->modifierProduit($id,$quantite); 
        return;
    }
    
}

?>