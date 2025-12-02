<?php
$deleted = false;
include 'conexao.php';
if(isset($_POST['confirmar'])) {
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM clientes WHERE id = '$id'";
    $sql_query = $mysqli-> query($sql_code) or die($mysqli->error);

    if($sql_query) {
        $deleted = true;
    }
}
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente | Psicóloga Waldirene Paulino</title>
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
            <div class="relative">
                <button id="notification-btn" class="p-2 rounded-full hover:bg-indigo-600 relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span id="notification-badge" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg z-50">
                    <div class="p-4 border-b"><h3 class="font-semibold text-gray-800">Notificações</h3></div>
                    <div class="max-h-60 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b"> <div class="flex items-center"> <div class="bg-blue-100 p-2 rounded-full mr-3"><i class="fas fa-calendar-check text-blue-500"></i></div>
                            <div><p class="text-sm font-medium text-gray-800">Novo agendamento confirmado</p><p class="text-xs text-gray-500">15 minutos atrás</p></div></div></a>
                    </div>
                    <div class="p-2 bg-gray-50 text-center"><a href="#" class="text-sm text-indigo-600 font-medium">Ver todas</a></div>
                </div>
            </div>
        </div>
    </header>

    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-center md:justify-start">
                <a href="index.php" class="py-4 px-6 text-pink-500 font-medium border-b-2 border-pink-500">Início</a>
                <a href="sobremim.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Sobre mim</a>
                <a href="servicos.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Serviços</a>
                <a href="perguntasfrequentes.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Perguntas Frequentes</a>
                <a href="meusagendamentos.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Meus Agendamentos</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <div class="card">
            <?php if ($deleted): ?>
                <h2 class="text-xl font-semibold text-green-600">Cliente deletado com sucesso!</h2>
                <p class="mt-4"><a href="/siteoficial/clientes.php" class="text-indigo-600">Clique aqui</a> para voltar para a lista de clientes.</p>
            <?php else: ?>
                <h1 class="text-2xl font-semibold">Tem certeza que deseja deletar este cliente?</h1>
                <form action="?id=<?= $id ?>" method="post" class="mt-4">
                    <a href="/siteoficial/clientes.php" class="mr-6 text-gray-700">Não</a>
                    <button name="confirmar" value="1" type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Sim, deletar</button>
                </form>
            <?php endif; ?>
        </div>
    </main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const notificationBtn = document.getElementById('notification-btn');
    const notificationDropdown = document.getElementById('notification-dropdown');

    if (notificationBtn) {
      notificationBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle('hidden');
      });

      document.addEventListener('click', function (event) {
        if (!notificationBtn.contains(event.target) && !notificationDropdown.contains(event.target)) {
          notificationDropdown.classList.add('hidden');
        }
      });
    }
});
</script>

<!-- Footer incluído pelo Controller::render; include removido para evitar duplicação -->