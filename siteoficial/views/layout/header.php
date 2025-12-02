<?php
// header.php - cabeçalho compartilhado
include_once __DIR__ . '/../../core/Flash.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Psicóloga Waldirene Paulino' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .calendar-day:hover { transform: scale(1.05); transition: all 0.2s ease; }
        .service-card:hover { box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }
        #notification-badge { animation: pulse 2s infinite; }
        @keyframes pulse { 0%{opacity:1;}50%{opacity:0.5;}100%{opacity:1;} }
        /* Transitions e variação de pink mais forte */
        .pink-transition { transition: background-color .18s ease, color .18s ease, transform .12s ease; }
        .calendar-day { transition: background-color .18s ease, color .18s ease, transform .12s ease; }
        .time-slot { transition: background-color .18s ease, color .18s ease, transform .12s ease; }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <header class="bg-indigo-700 text-white shadow-lg" style="background-color:rgb(182, 233, 188);">
        <div class="container mx-auto px-4 py-8 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
                <div class="bg-white rounded-full p-2 mr-3">
                    <i class="fas fa-brain text-pink-500 text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-black">Psicóloga Wal Paulino</h1>
            </div>
            <div class="relative flex items-center space-x-3">
                <!-- Botão do carrinho substitui o sino -->
                <button id="cart-btn" class="p-2 rounded-full hover:bg-pink-600 hover:text-white pink-transition relative" aria-label="Carrinho">
                    <i class="fas fa-shopping-cart text-xl pink-transition"></i>
                    <span id="notification-badge" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>

                <!-- Botão de login verde arredondado -->
                <a href="meusagendamentos.php" id="login-btn" class="bg-green-500 text-white px-3 py-2 rounded-full font-medium hover:bg-green-600">Login</a>

                <div id="notification-dropdown" class="hidden absolute right-0 mt-12 w-72 bg-white rounded-md shadow-lg z-50">
                    <div class="p-4 border-b"><h3 class="font-semibold text-gray-800">Notificações</h3></div>
                    <div class="max-h-60 overflow-y-auto">
                        <?php if (!empty($notifications) && is_array($notifications)): ?>
                            <?php foreach($notifications as $note): ?>
                                <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b">
                                    <div class="flex items-center">
                                        <div class="bg-<?php echo $note['color']; ?>-100 p-2 rounded-full mr-3">
                                            <i class="<?php echo $note['icon']; ?> text-<?php echo $note['color']; ?>-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800"><?php echo $note['message']; ?></p>
                                            <p class="text-xs text-gray-500"><?php echo $note['time']; ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="p-4 text-sm text-gray-500">Sem notificações</div>
                        <?php endif; ?>
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
                <a href="meusagendamentos.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Meus agendamentos</a>
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8">

    <?php if (has_flash('success')): ?>
        <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-200">
            <?= htmlspecialchars(get_flash('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (has_flash('error')): ?>
        <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-200">
            <?= htmlspecialchars(get_flash('error')) ?>
        </div>
    <?php endif; ?>
