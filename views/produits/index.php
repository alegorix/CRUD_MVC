<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
<h1 class="text-center my-4">Liste des Produits</h1>

<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>Produits</h2>
        <a href="index.php?action=create" class="btn btn-success">Ajouter un produit</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Nombre</th>
                <th>Actif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['produit']) ?></td>
                    <td><?= htmlspecialchars($produit['prix']) ?> €</td>
                    <td><?= htmlspecialchars($produit['nombre']) ?></td>
                    <td>
                        <span class="badge <?= $produit['actif'] ? 'bg-success' : 'bg-danger' ?>">
                            <?= $produit['actif'] ? 'Actif' : 'Inactif' ?>
                        </span>
                    </td>
                    <td>
                        <a href="index.php?action=edit&id=<?= $produit['id'] ?>" class="btn btn-primary btn-sm">Éditer</a>
                        <a href="index.php?action=toggleActif&id=<?= $produit['id'] ?>" class="btn btn-warning btn-sm">
                            <?= $produit['actif'] ? 'Désactiver' : 'Activer' ?>
                        </a>
                        <a href="index.php?action=details&id=<?= $produit['id'] ?>" class="btn btn-info btn-sm">Détails</a>
                        <a href="index.php?action=delete&id=<?= $produit['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
