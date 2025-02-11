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
        <div class="card-header bg-success text-white">
            <h2>Ajouter un produit</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?action=create">
                <div class="mb-3">
                    <label class="form-label">Produit :</label>
                    <input type="text" class="form-control" name="produit" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prix :</label>
                    <input type="text" class="form-control" name="prix" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre :</label>
                    <input type="number" class="form-control" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Actif :</label>
                    <select class="form-select" name="actif">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>