<?php

class Produit {
    private $conn;
    private $table_name = "liste";

    public $id;
    public $produit;
    public $prix;
    public $nombre;
    public $actif;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (produit, prix, nombre, actif) 
                  VALUES (:produit, :prix, :nombre, :actif)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":produit", $this->produit);
        $stmt->bindParam(":prix", $this->prix);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":actif", $this->actif);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, produit, prix, nombre, actif FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET produit = :produit, prix = :prix, nombre = :nombre, actif = :actif 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":produit", $this->produit);
        $stmt->bindParam(":prix", $this->prix);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":actif", $this->actif);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
