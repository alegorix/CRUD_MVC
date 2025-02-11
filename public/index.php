<?php

// Inclure les fichiers nécessaires
require_once '../config/database.php';
require_once '../controllers/ProduitController.php';

// Récupérer l'action et l'ID de l'URL (si présents)
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Créer une instance du contrôleur Produit
$produitController = new ProduitController();

// Rediriger en fonction de l'action (index, create, edit, delete, toggleActif, details)
if ($action == 'create') {
    $produitController->create();
} elseif ($action == 'edit' && $id) {
    $produitController->edit($id);
} elseif ($action == 'delete' && $id) {
    $produitController->delete($id);
} elseif ($action == 'toggleActif' && $id) {
    $produitController->toggleActif($id);
} elseif ($action == 'details' && $id) {
    $produitController->details($id);
} else {
    $produitController->index(); // Afficher la liste des produits par défaut
}
?>
