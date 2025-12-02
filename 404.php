<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro - Página não encontrada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/custom.css">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            background-color: rgb(247, 215, 241);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .image-container {
            max-width: 50%;
            margin-bottom: 30px;
        }

        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="../imagens/404.jpg" alt="Erro 404">
    </div>

    <div class="btn-container">
        <a href="index.php" class="btn rounded-pill btn-verde">Voltar para a página inicial</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
