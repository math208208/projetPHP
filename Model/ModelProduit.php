<?php 

class ModelProduit{
    private $db;
    
    public function __construct() {
        $this->db = new PDO('mysql:host=linserv-info-01.campus.unice.fr;dbname=mm302494_ProjetPhp', 'mm302494', 'mm302494');
    }

    public function getStock(){
        $sql= "SELECT * FROM gestion_stock";
        $stmt = $this->db->prepare($sql);


        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    
    public function getProduitsPagines($page, $produitsParPage) {
        
        $start = ($page - 1) * $produitsParPage;
        $sql = "SELECT * FROM produits LIMIT :start, :produitsParPage";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':produitsParPage', $produitsParPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNombreProduits() {
        $sql = "SELECT COUNT(*) AS total FROM produits";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }


    public function getProduitsBySearch($searchTerm, $limit, $offset) {
        $sql = "SELECT * FROM produits 
                WHERE titre LIKE :search OR description LIKE :search 
                OR descriptif LIKE :search 
                LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $search = '%' . $searchTerm . '%';
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProduitsBySearch($searchTerm) {
        $sql = "SELECT COUNT(*) AS total FROM produits 
                WHERE titre LIKE :search OR description LIKE :search  OR descriptif LIKE :search";

        $stmt = $this->db->prepare($sql);
        $search = '%' . $searchTerm . '%';
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }



public function getProduitsByCategoryAndPagination($category, $limit, $offset) {
        $sql = "SELECT * FROM produits";
    
        // Filtrer par catégorie si nécessaire
        if ($category === 'sans_chocolat') {
            $sql .= " WHERE description NOT LIKE :filter AND descriptif NOT LIKE :filter";
        } else if ($category === 'box') {
            $sql .= " WHERE description LIKE :filter";
        }
    
        $sql .= " LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
    
        // Ajout des paramètres
        if ($category === 'sans_chocolat') {
            $stmt->bindValue(':filter', '%chocolat%', PDO::PARAM_STR);
        } else if ($category === 'box') {
            $stmt->bindValue(':filter', '%PACK%', PDO::PARAM_STR);
        }
    
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countProduitsByCategory($category) {
        $sql = "SELECT COUNT(*) as total FROM produits";
    
        // Filtrer par catégorie si nécessaire
        if ($category === 'sans_chocolat') {
            $sql .= " WHERE description NOT LIKE :filter AND descriptif NOT LIKE :filter";
        } else if ($category === 'box') {
            $sql .= " WHERE description LIKE :filter";
        }
    
        $stmt = $this->db->prepare($sql);
    
        // Ajout des paramètres
        if ($category === 'sans_chocolat') {
            $stmt->bindValue(':filter', '%chocolat%', PDO::PARAM_STR);
        } else if ($category === 'box') {
            $stmt->bindValue(':filter', '%PACK%', PDO::PARAM_STR);
        }
    
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

}
    



?>