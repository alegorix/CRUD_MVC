<?php

require_once '../models/Produit.php';

class ProduitController {

    private $db;
    private $produit;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->produit = new Produit($this->db);
    }

    public function index() {
        $stmt = $this->produit->read();
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once '../views/produits/index.php';
    }

    public function create() {
        if ($_POST) {
            $this->produit->produit = $_POST['produit'];
            $this->produit->prix = $_POST['prix'];
            $this->produit->nombre = $_POST['nombre'];
            $this->produit->actif = $_POST['actif'];

            if ($this->produit->create()) {
                header('Location: index.php');
            } else {
                echo "Erreur lors de la création du produit.";
            }
        }

        require_once '../views/produits/create.php';
    }
    
    
    public function toggleActif($id) {
    // Récupérer l'état actuel du produit
    $query = "SELECT actif FROM liste WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Vérifier si le produit existe
    if ($stmt->rowCount() > 0) {
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
        $newActif = $produit['actif'] == 1 ? 0 : 1; // Inverser l'état actif

        // Mettre à jour l'état actif du produit
        $updateQuery = "UPDATE liste SET actif = :actif WHERE id = :id";
        $updateStmt = $this->db->prepare($updateQuery);
        $updateStmt->bindParam(":actif", $newActif);
        $updateStmt->bindParam(":id", $id);
        
        if ($updateStmt->execute()) {
            header('Location: index.php'); // Rediriger vers la liste des produits
        } else {
            echo "Erreur lors de la mise à jour de l'état actif.";
        }
    } else {
        echo "Produit introuvable.";
    }
}

	public function details($id) {
    // Récupérer un produit spécifique par son ID
    $query = "SELECT id, produit, prix, nombre, actif FROM liste WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Vérifier si le produit existe
    if ($stmt->rowCount() > 0) {
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Produit introuvable";
        return;
    }

    // Afficher la vue des détails du produit
    require_once '../views/produits/details.php';
}


   public function edit($id) {
    // Récupérer un produit spécifique par son ID
    $query = "SELECT id, produit, prix, nombre, actif FROM liste WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Vérifier si le produit existe
    if ($stmt->rowCount() > 0) {
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Produit introuvable";
        return;
    }

    // Vérifier si le formulaire a été soumis
    if ($_POST) {
        $this->produit->id = $id;
        $this->produit->produit = $_POST['produit'];
        $this->produit->prix = $_POST['prix'];
        $this->produit->nombre = $_POST['nombre'];
        $this->produit->actif = $_POST['actif'];

        // Mettre à jour le produit
        if ($this->produit->update()) {
            header('Location: index.php');
        } else {
            echo "Erreur lors de la mise à jour du produit.";
        }
    }

    // Passer les données du produit à la vue pour les afficher dans le formulaire
    require_once '../views/produits/edit.php';
}
    public function delete($id) {
        $this->produit->id = $id;
        if ($this->produit->delete()) {
            header('Location: index.php');
        } else {
            echo "Erreur lors de la suppression du produit.";
        }
    }
}
?>
