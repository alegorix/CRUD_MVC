```markdown
# Intégration d'AJAX dans un projet PHP (MVC, PDO)

Ce guide explique comment intégrer **AJAX** dans une application PHP utilisant **le modèle MVC avec PDO**.

## Structure du projet

```plaintext
/mon-projet/
│── /app/
│   ├── /controllers/
│   │   ├── VilleController.php
│   ├── /models/
│   │   ├── Ville.php
│   ├── /views/
│   │   ├── villes.php
│── /public/
│   ├── index.php
│   ├── script.js
│── /config/
│   ├── database.php
│── .htaccess
│── route.php
```

## 1. AJAX avec jQuery

### **Fichier `public/script.js`**

```javascript
$(document).ready(function() {
    $("#loadCities").click(function() {
        $.ajax({
            url: "http://localhost/mon-projet/public/api/villes",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let output = "<ul>";
                data.forEach(ville => {
                    output += `<li>${ville.nom}</li>`;
                });
                output += "</ul>";
                $("#cityList").html(output);
            }
        });
    });

    $("#addCity").click(function() {
        let cityName = $("#cityName").val();
        $.ajax({
            url: "http://localhost/mon-projet/public/api/add_ville",
            type: "POST",
            data: { nom: cityName },
            success: function(response) {
                alert("Ville ajoutée avec succès !");
                $("#cityName").val("");
                $("#loadCities").click();
            }
        });
    });
});
```

## 2. Gestion des routes

### **Fichier `routes.php`** ou router dans l'index.php

```php
if ($_GET['url'] === "api/villes") {
    require_once "app/controllers/VilleController.php";
    $controller = new VilleController();
    echo json_encode($controller->getVilles());
    exit;
}

if ($_GET['url'] === "api/add_ville") {
    require_once "app/controllers/VilleController.php";
    $controller = new VilleController();
    echo json_encode($controller->addVille($_POST['nom']));
    exit;
}
```

## 3. Contrôleur MVC

### **Fichier `app/controllers/VilleController.php`**

```php
require_once "app/models/Ville.php";

class VilleController {
    public function getVilles() {
        $ville = new Ville();
        return $ville->getAll();
    }

    public function addVille($nom) {
        $ville = new Ville();
        return $ville->insert($nom);
    }
}
```

## 4. Modèle PDO

### **Fichier `app/models/Ville.php`**

```php
require_once "config/database.php";

class Ville {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM villes";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nom) {
        $sql = "INSERT INTO villes (nom) VALUES (:nom)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nom", $nom);
        return $stmt->execute();
    }
}
```

## 5. Connexion PDO

### **Fichier `config/database.php`**

```php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $this->connection = new PDO("mysql:host=localhost;dbname=testdb", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
```

## 6. Vue avec AJAX

### **Fichier `views/villes.php`**

```html
<button id="loadCities">Charger les villes</button>
<div id="cityList"></div>

<input type="text" id="cityName" placeholder="Nom de la ville">
<button id="addCity">Ajouter la ville</button>

<script src="script.js"></script>
```

## Fonctionnement

1. L'utilisateur clique sur **"Charger les villes"**.
2. **AJAX** envoie une requête à `http://localhost/mon-projet/public/api/villes`.
3. **Route PHP** détecte `api/villes` et appelle `VilleController.php`.
4. `VilleController` récupère les villes via `Ville.php`.
5. **Les villes sont retournées en JSON**.
6. **AJAX met à jour la page sans recharger**.
7. L'utilisateur entre un nom de ville et clique sur **"Ajouter la ville"**.
8. **AJAX** envoie la requête POST à `api/add_ville`.
9. **VilleController** insère la nouvelle ville via `Ville.php`.
10. **Le succès est affiché et la liste est rechargée.**

## Exemple de fichier JSON
```json
{
    "encoding": "UTF-16",
    "status": "success",
    "message": "Exemple de fichier JSON",
    "data": [
        {
            "id": 1,
            "nom": "Charleroi",
            "population": 201000
        },
        {
            "id": 2,
            "nom": "Namur",
            "population": 110000
        },
        {
            "id": 3,
            "nom": "Liège",
            "population": 197000
        }
    ]
}


