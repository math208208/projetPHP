CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(64) NOT NULL,
    prenom VARCHAR(64) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE produits (
    reference VARCHAR(64) UNIQUE NOT NULL,
    id INT AUTO_INCREMENT PRIMARY KEY,
   	description VARCHAR(64) NOT NULL,
    prix_public DECIMAL(10, 2) NOT NULL,
    prix_achat DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    icone VARCHAR(255),
    titre VARCHAR(64) NOT NULL,
    descriptif TEXT NOT NULL
);

CREATE TABLE facturation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    client_id INT NOT NULL,
    total_ht DECIMAL(10, 2) NOT NULL,
    total_ttc DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE gestion_stock (
    produit_id INT NOT NULL,
    seuil_critique INT NOT NULL,
    quantité INT NOT NULL,
    FOREIGN KEY (produit_id) REFERENCES produits(id)
);

CREATE TABLE produitPanier (
    idPanier INT NOT NULL,
    idProduit INT NOT NULL,
    quantite INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idPanier) REFERENCES facturation(id),
    FOREIGN KEY (idProduit) REFERENCES produits(id),
    FOREIGN KEY (prix) REFERENCES produits(prix_public)
    
);
