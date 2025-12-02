<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conexao.php';

$id = filter_input(INPUT_GET, 'id_cliente', FILTER_VALIDATE_INT);
if (!$id || $id <= 0) {
    die("ID inválido. ID recebido: " . var_export($_GET['id_cliente'], true));
}

function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}

$updated = false;
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $celular = trim($_POST['celular']);

    if (empty($nome)) {
        $error_message = "Preencha o campo nome";
    } elseif (empty($celular)) {
        $error_message = "Preencha o campo celular";
    } else {
        $celular = limpar_texto($celular);
        if (strlen($celular) != 11) {
            $error_message = "O celular deve ter 11 dígitos. Ex: (44) 99999-9999";
        }
    }

    if (empty($error_message)) {
        $stmt = $mysqli->prepare("
            UPDATE clientesnovos
            SET nome = ?, email = ?, celular = ?
            WHERE id_cliente = ?
        ");
        $stmt->bind_param("sssi", $nome, $email, $celular, $id);

        if ($stmt->execute()) {
            $updated = true;
        } else {
            $error_message = "Erro ao atualizar: " . $stmt->error;
        }

        $stmt->close();
    }
}

$stmt = $mysqli->prepare("SELECT * FROM clientesnovos WHERE id_cliente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();
if (!$cliente) {
    die("Cliente não encontrado.");
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente | Psicóloga Waldirene Paulino</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card { max-width:760px; margin:40px auto; background:#fff; padding:28px; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,0.08);} 
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <header class="bg-indigo-700 text-white shadow-lg" style="background-color:rgb(182, 233, 188)">
        <div class="container mx-auto px-4 py-8 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
                <div class="bg-white rounded-full p-2 mr-3">
                    <i class="fas fa-brain text-pink-500 text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-black">Psicóloga Wal Paulino</h1>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="card">
            <a href="/siteoficial/clientesnovos.php" class="text-indigo-600">Voltar para a lista</a>

            <?php if (!empty($error_message)): ?>
                <p class="mt-4 text-red-600"><b><?= htmlspecialchars($error_message) ?></b></p>
            <?php endif; ?>

            <?php if ($updated): ?>
                <p class="mt-4 text-green-600"><b>Cliente atualizado com sucesso!</b></p>
            <?php endif; ?>

            <form method="POST" action="editar_cliente.php?id_cliente=<?= $id ?>" class="mt-4">
                <div class="mb-4">
                    <label class="block font-medium">Nome</label>
                    <input value="<?= htmlspecialchars($cliente['nome']) ?>" name="nome" type="text" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">E-mail</label>
                    <input value="<?= htmlspecialchars($cliente['email']) ?>" name="email" type="email" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Celular</label>
                    <input value="<?= htmlspecialchars($cliente['celular']) ?>" name="celular" type="text" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Salvar Cliente</button>
                </div>
            </form>
        </div>
    </main>
    <?php include __DIR__ . '/views/layout/footer.php'; ?>
</body>
</html>


