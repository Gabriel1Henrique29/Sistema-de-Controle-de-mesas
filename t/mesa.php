<?php
$mesas = range(1, 15);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pedidos - Petiscaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-4">
        <header class="text-center">
            <h1>Sistema de Pedidos - Petiscaria</h1>
        </header>

        <section class="mt-4">
            <h2>Mesas</h2>
            <div class="row">
                <?php for ($i = 1; $i <= 15; $i++) { 
                    if ($i == 13) continue; // Pula a mesa 13
                ?>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Mesa <?php echo $i; ?></h5>
                                <a href="pedido.php?mesa=<?php echo $i; ?>" class="btn btn-primary">Novo Pedido</a>
                                <a href="pedidos.php?mesa=<?php echo $i; ?>" class="btn btn-secondary">Ver Pedidos</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
