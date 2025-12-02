<?php
$notifications = [
    ["icon" => "fas fa-calendar-check", "color" => "blue", "message" => "Novo agendamento confirmado", "time" => "15 minutos atrás"],
    ["icon" => "fas fa-exclamation-triangle", "color" => "yellow", "message" => "Lembrete: Consulta amanhã às 10h", "time" => "2 horas atrás"],
    ["icon" => "fas fa-envelope", "color" => "green", "message" => "E-mail enviado para cliente", "time" => "Ontem"]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psicóloga Waldirene Paulino | Agendamentos e Serviços</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .calendar-day:hover {
            transform: scale(1.05);
            transition: all 0.2s ease;
        }
        .service-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        #notification-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
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
            <div class="relative">
                <button id="notification-btn" class="p-2 rounded-full hover:bg-indigo-600 relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span id="notification-badge" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"><?php echo count($notifications); ?></span>
                </button>
                <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg z-50">
                    <div class="p-4 border-b">
                        <h3 class="font-semibold text-gray-800">Notificações</h3>
                    </div>
                    <div class="max-h-60 overflow-y-auto">
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
                    </div>
                    <div class="p-2 bg-gray-50 text-center">
                        <a href="#" class="text-sm text-indigo-600 font-medium">Ver todas</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-center md:justify-start">
                <a href="index.php?param=home" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Início</a>
                <a href="index.php?param=sobremim" class="py-4 px-6 text-pink-500 font-medium border-b-2 border-pink-500">Sobre mim</a>
                <a href="servicos.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Serviços</a>
                <a href="index.php?param=perguntasfrequentes" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Perguntas Frequentes</a>
                <a href="index.php?param=meusagendamentos" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">meus agendamentos</a>
            </div>
        </div>
    </nav>

    <section class="container mx-auto px-4 py-12 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-8 md:mb-0">
            <img src="psi.png" alt="Psicóloga Waldirene Paulino" class="rounded-lg shadow-lg w-96 h-auto mx-auto">
        </div>
        <div class="md:w-1/2 md:pl-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Psicóloga Waldirene Gobira Paulino</h1>
            <h2 class="text-lg text-gray-700 mb-4">
                Profissionalmente, é Pedagoga pelo Centro Universitário Leonardo da Vinci (Uniasselvi)
                e formanda em Psicologia pelo Centro Universitário Integrado de Campo Mourão.
            </h2>
            <p class="text-gray-600">
                Oferece atendimento humanizado, com foco no bem-estar emocional e psicológico dos pacientes,
                proporcionando um espaço seguro e acolhedor para o desenvolvimento pessoal.
            </p>
        </div>
    </section>
    <!-- Footer incluído pelo Controller::render; include removido para evitar duplicação -->
</body>
</html>
