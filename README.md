# Arbo - Liens

.htaccess > Redirection vers /public/index.php

## /public/index.php

- analyse de l'url afin de trouver l'action à réaliser et l'id du produit (si nécessaire)
- redirection vers l'action voulue dans le contrôleur produit

## /controllers/ProduitController.php

- chargement du modèle Produit (Là où se trouve les requêtes SQL)
- exécution de la fonction voulue
- Chargement de la vue voulue
  
