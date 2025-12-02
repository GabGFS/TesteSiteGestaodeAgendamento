<?php
include 'conexao.php';

$sql_clientes = "SELECT * FROM clientesnovos";
$query_clientes = $mysqli->query($sql_clientes);

if (!$query_clientes) {
    die("Erro na consulta: " . $mysqli->error);
}

$num_clientes = $query_clientes->num_rows;

function formatar_celular($cel) {
    if(strlen($cel) == 11){
        return preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $cel);
    }
    return $cel;
}

function formatar_data($data) {
    if($data && $data != "0000-00-00") {
        return date("d/m/Y", strtotime($data));
    }
    return "Não informada";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes | Psicóloga Waldirene Paulino</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card { max-width:1100px; margin:40px auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,0.08);} 
        table { width:100%; border-collapse:collapse; }
        th, td { padding:10px; border-bottom:1px solid #e5e7eb; text-align:left; }
        th { background:#f9fafb; }
        a.action { margin-right:10px; color:#2563eb; }
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
            <h1 class="text-2xl font-semibold mb-2">Lista de Clientes</h1>
            <p class="text-sm text-gray-600 mb-4">Estes são os clientes cadastrados no seu sistema:</p>

            <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Data de nascimento</th>
                        <th>Data de cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($num_clientes == 0) { ?>
                        <tr>
                            <td colspan="8">Nenhum cliente foi cadastrado.</td>
                        </tr>
                    <?php } else { 
                        while($cliente = $query_clientes->fetch_assoc()) {

                            $celular = !empty($cliente['celular']) ? formatar_celular($cliente['celular']) : "Não informado";
                            $nascimento = !empty($cliente['nascimento']) ? formatar_data($cliente['nascimento']) : "Não informada";
                            $data_de_cadastro = !empty($cliente['data_de_cadastro']) ? date("d/m/Y H:i", strtotime($cliente['data_de_cadastro'])) : "Não informada";
                            ?>
                            <tr>
                                <td><?php echo $cliente['id_cliente']; ?></td>
                                <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                                <td><?php echo htmlspecialchars($celular); ?></td>
                                <td><?php echo htmlspecialchars($nascimento); ?></td>
                                <td><?php echo htmlspecialchars($data_de_cadastro); ?></td>
                                <td>
                                    <a class="action" href="editar_cliente.php?id_cliente=<?php echo $cliente['id_cliente']; ?>">Editar</a>
                                    <a class="action" href="deletar_cliente.php?id_cliente=<?php echo $cliente['id_cliente']; ?>">Deletar</a>
                                </td>
                            </tr>
                            <?php 
                        } 
                    } ?>
                </tbody>
            </table>
            </div>
        </div>
    </main>
</body>
</html>
