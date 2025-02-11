<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2>Détails du Produit</h2>
        </div>
        <div class="card-body">
            <?php if (isset($produit)): ?>
                <p><strong>Nom du produit :</strong> <?= htmlspecialchars($produit['produit']) ?></p>
                <p><strong>Prix :</strong> <?= htmlspecialchars($produit['prix']) ?> €</p>
                <p><strong>Quantité :</strong> <?= htmlspecialchars($produit['nombre']) ?></p>
                <p><strong>Statut :</strong> 
                    <span class="badge <?= $produit['actif'] ? 'bg-success' : 'bg-danger' ?>">
                        <?= $produit['actif'] ? 'Actif' : 'Inactif' ?>
                    </span>
                </p>
                <a href="index.php?action=index" class="btn btn-secondary">Retour</a>
            <?php else: ?>
                <p class="text-danger">Produit non trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>