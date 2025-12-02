<?php
// Página de contato simples
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | Psicóloga Waldirene Paulino</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Pequenas customizações possíveis */
        .contact-card { max-width: 760px; margin: 40px auto; background:#fff; padding:28px; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,0.08);} 
        .contact-title { font-size:1.8rem; color:#1f2f29; margin-bottom:12px; }
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
                <a href="contato.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Contato</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <div class="contact-card">
            <h2 class="contact-title">Entre em contato</h2>
            <p>Se preferir, envie uma mensagem pelo formulário abaixo ou utilize os contatos informados na página.</p>

            <form method="post" action="#" class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="nome" placeholder="Seu nome" class="border rounded px-3 py-2" />
                    <input name="email" placeholder="Seu e-mail" class="border rounded px-3 py-2" />
                </div>
                <textarea name="mensagem" placeholder="Escreva sua mensagem" class="w-full mt-4 border rounded px-3 py-2" rows="5"></textarea>
                <div class="mt-4">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded font-medium">Enviar mensagem</button>
                </div>
            </form>
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

</body>
</html>