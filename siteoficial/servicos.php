<?php
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
        /* Remove scrollbar feio no Chrome/Firefox */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- HEADER -->
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
                    <span id="notification-badge" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg z-50">
                    <div class="p-4 border-b">
                        <h3 class="font-semibold text-gray-800">Notificações</h3>
                    </div>
                    <div class="max-h-60 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-calendar-check text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Novo agendamento confirmado</p>
                                    <p class="text-xs text-gray-500">15 minutos atrás</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b">
                            <div class="flex items-center">
                                <div class="bg-yellow-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Lembrete: Consulta amanhã às 10h</p>
                                    <p class="text-xs text-gray-500">2 horas atrás</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-envelope text-green-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">E-mail enviado para cliente</p>
                                    <p class="text-xs text-gray-500">Ontem</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 bg-gray-50 text-center">
                        <a href="#" class="text-sm text-indigo-600 font-medium">Ver todas</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- NAV -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-center md:justify-start">
                <a href="index.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Início</a>
                <a href="sobremim.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Sobre mim</a>
                <a href="servicos.php" class="py-4 px-6 text-pink-500 font-medium border-b-2 border-pink-500">Serviços</a>
                <a href="perguntasfrequentes.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Perguntas Frequentes</a>
                <a href="meusagendamentos.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Meus Agendamentos</a>
            </div>
        </div>
    </nav>

    <!-- SEÇÃO SERVIÇOS -->
    <main class="w-full bg-gray-100 py-1">
        <div class="w-full bg-white py-4 px-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Serviços</h2>
            <div class="flex gap-6 overflow-x-auto no-scrollbar px-4">
                <?php
                $servicos = [
                    ['titulo'=>'Psicoterapia Individual','descricao'=>'Sessões individuais para autoconhecimento e desenvolvimento pessoal.','cor'=>'indigo','link'=>'meusagendamentos.php','foto'=>'terapiaind.jpg'],
                    ['titulo'=>'Psicoterapia de Casal','descricao'=>'Ajuda para casais melhorarem comunicação e relacionamento.','cor'=>'pink','link'=>'meusagendamentos.php','foto'=>'casalpsi.jpg'],
                    ['titulo'=>'Grupo de Apoio para Bariátricas','descricao'=>'Suporte emocional para pacientes no pré e pós-operatório.','cor'=>'green','link'=>'meusagendamentos.php','foto'=>'grupo.jpeg'],
                    ['titulo'=>'Palestras','descricao'=>'Eventos sobre saúde mental e bem-estar psicológico.','cor'=>'purple','link'=>'meusagendamentos.php','foto'=>'Palestra.png'],
                    ['titulo'=>'Orientação Profissional','descricao'=>'Auxílio na escolha e desenvolvimento de carreira.','cor'=>'yellow','link'=>'meusagendamentos.php','foto'=>'ori.jpg']
                ];

                foreach($servicos as $servico){
                    echo '<div class="flex-none w-60 sm:w-54 md:w-71 bg-'.$servico['cor'].'-50 rounded-lg shadow-lg overflow-hidden cursor-pointer transition-transform duration-300 hover:scale-105">';
                    echo '<img src="'.$servico['foto'].'" alt="'.$servico['titulo'].'" class="w-full h-48 object-cover">';
                    echo '<div class="p-4 flex flex-col justify-between">';
                    echo '<h3 class="font-semibold text-'.$servico['cor'].'-800 text-lg">'.$servico['titulo'].'</h3>';
                    echo '<p class="text-sm text-gray-700 mt-2">'.$servico['descricao'].'</p>';
                    echo '<a href="index.php" class="text-'.$servico['cor'].'-600 font-medium mt-3 hover:underline">Agendar</a>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>
<?php include __DIR__ . '/views/layout/footer.php'; ?>
