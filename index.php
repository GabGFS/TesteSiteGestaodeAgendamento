<?php include'conexao.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $clientName = $_POST['client-name'];
    $clientEmail = $_POST['client-email'];
    $clientPhone = $_POST['client-phone'];
    $serviceType = $_POST['service-type'];
    $appointmentNotes = $_POST['appointment-notes'];
    $selectedDateTime = $_POST['selected-date-time'];

    // Validação básica (pode ser aprimorada)
    if (!empty($clientName) && !empty($clientEmail)) {

        $querySuccess = $mysqli->query("INSERT INTO clientesnovos (nome, email, celular)
    VALUES ('$clientName', '$clientEmail', '$clientPhone')") or die($mysqli->error);

        // Executar a query para inserir o cliente
        /*
        if ($querySuccess) {
            $idCliente = $mysqli->insert_id; // Obter o ID do cliente inserido

            // Inserir o serviço (você pode precisar ajustar isso dependendo da sua lógica)
            $sql_servico = "INSERT INTO servicos (nome) VALUES ('$serviceType')";
            if ($mysqli->query($sql_servico)) {
                $idServico = $mysqli->insert_id; // Obter o ID do serviço inserido
                $data_e_hora_agendamento = $selectedDateTime;

                $sql_agendamento = "INSERT INTO agendamento (id_cliente, id_servico, data_e_hora_agendamento, observacoes) VALUES ($idCliente, $idServico, '$data_e_hora_agendamento', '$appointmentNotes')";

                if ($mysqli->query($sql_agendamento)) {
                    echo "<script>alert('Agendamento realizado com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao inserir cliente: " . $mysqli->error . "');</script>";
                }

            } else {
                echo "<script>alert('Erro ao inserir cliente: " . $mysqli->error . "');</script>";
            }
        } else {
            echo "<script>alert('Erro ao inserir cliente: " . $mysqli->error . "');</script>";
        }
        */

        $mysqli->close();
    } else {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios antes de concluir o agendamento.');</script>";
    }
}
// Inicializa variáveis
$nome = $email = $website = $comentario = $genero = "";
$nomeErro = $emailErro = $websiteErro = $generoErro = "";
$enviado = false;

// Processa o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enviado = true;

    // Valida nome
    if (empty($_POST['client-name']) || strlen($_POST['client-name']) < 3 || strlen($_POST['client-name']) > 50) {
        $nomeErro = "Preencha o campo nome corretamente (3-50 caracteres).";
    } else {
        $nome = htmlspecialchars($_POST['client-name']);
    }

    // Valida e-mail
    if (empty($_POST['client-email'])) {
        $emailErro = "Preencha o campo e-mail.";
    } elseif (!filter_var($_POST['client-email'], FILTER_VALIDATE_EMAIL)) {
        $emailErro = "Preencha o campo e-mail com um e-mail válido.";
    } else {
        $email = htmlspecialchars($_POST['client-email']);
    }

    // Valida telefone
    if (empty($_POST['client-phone'])) {
        $websiteErro = "Preencha corretamente o campo telefone.";
    } else {
        $website = htmlspecialchars($_POST['client-phone']);
    }

    // Comentário (opcional)
    if (!empty($_POST['appointment-notes'])) {
        $comentario = htmlspecialchars($_POST['appointment-notes']);
    }

    // Gênero (ou outro campo adicional, se necessário)
    if (isset($_POST['service-type'])) {
        $genero = $_POST['service-type'];
        if (!in_array($genero, ['individual', 'couple', 'group', 'lecture', 'career'])) {
            $generoErro = "Escolha entre as opções de serviço disponíveis.";
        }
    } else {
        $generoErro = "Selecione um serviço.";
    }
}
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
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <header class="bg-indigo-700 text-white shadow-lg" style="background-color:rgb(182, 233, 188)" ;>
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
                    <span id="notification-badge"
                        class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <div id="notification-dropdown"
                    class="hidden absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg z-50">
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
        </div>
    </header>
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-center md:justify-start">
                <a href="index.php"
                    class="py-4 px-6 text-pink-500 font-medium border-b-2 border-pink-500">Início</a>
                <a href="sobremim.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Sobre
                    mim</a>
                    <a href="servicos.php" class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Serviços</a>
                <a href="perguntasfrequentes.php"
                    class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Perguntas Frequentes</a>
                <a href="contato.php"
                    class="py-4 px-6 text-gray-600 hover:text-pink-500 font-medium">Contato</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-1/3">

                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Horários Disponíveis</h2>
                    <div id="time-slots" class="grid grid-cols-3 gap-2">

                    </div>
                </div>
                <script>
                    // Lista de horários disponíveis (poderia vir do banco)
                    const horariosDisponiveis = [
                        "08:00", "09:00", "10:00",
                        "11:00", "13:00", "14:00",
                        "15:00", "16:00", "17:00"
                    ];

                    // Seleciona o container
                    const container = document.getElementById("time-slots");

                    // Função para criar os botões de horário
                    horariosDisponiveis.forEach(horario => {
                        const btn = document.createElement("button");
                        btn.textContent = horario;
                        btn.className = "bg-pink-300 text-white rounded-md py-2 px-4 hover:bg-green-600 focus:outline-none";

                        btn.addEventListener("click", () => {
                            document.querySelectorAll("#time-slots button").forEach(b => b.classList.remove("bg-green-600"));
                            btn.classList.add("bg-green-600");
                            console.log("Horário selecionado:", horario);
                            // Atualiza o campo oculto e o texto (se houver uma data selecionada)
                            const selectedDateEl = document.querySelector('.calendar-day.bg-indigo-600');
                            if (selectedDateEl) {
                                const day = parseInt(selectedDateEl.textContent);
                                const selectedDate = new Date(currentYear, currentMonth, day);
                                const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
                                const dateString = selectedDate.toLocaleDateString('pt-BR', options);
                                document.getElementById('selected-date-time').textContent = `${dateString} às ${horario}`;
                                document.getElementById('selected-date-time-input').value = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate(), horario.split(':')[0]).toISOString().slice(0,19).replace('T',' ');
                            }
                        });

                        container.appendChild(btn);
                    });
                </script>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Serviços</h2>
                    <div class="space-y-4">
                        <div class="service-card bg-indigo-50 rounded-lg p-4 cursor-pointer transition-all duration-300"
                            data-service="individual">
                            <h3 class="font-semibold text-indigo-800">Psicoterapia Individual</h3>
                            <p class="text-sm text-gray-600 mt-1">Sessões individuais para autoconhecimento e
                                desenvolvimento pessoal.</p>
                        </div>
                        <div class="service-card bg-pink-50 rounded-lg p-4 cursor-pointer transition-all duration-300"
                            data-service="couple">
                            <h3 class="font-semibold text-pink-800">Psicoterapia de Casal</h3>
                            <p class="text-sm text-gray-600 mt-1">Ajuda para casais melhorarem comunicação e
                                relacionamento.</p>
                        </div>
                        <div class="service-card bg-green-50 rounded-lg p-4 cursor-pointer transition-all duration-300"
                            data-service="group">
                            <h3 class="font-semibold text-green-800">Grupo de Apoio para Bariátricas</h3>
                            <p class="text-sm text-gray-600 mt-1">Suporte emocional para pacientes no pré e
                                pós-operatório.</p>
                        </div>
                        <div class="service-card bg-purple-50 rounded-lg p-4 cursor-pointer transition-all duration-300"
                            data-service="lecture">
                            <h3 class="font-semibold text-purple-800">Palestras</h3>
                            <p class="text-sm text-gray-600 mt-1">Eventos sobre saúde mental e bem-estar psicológico.
                            </p>
                        </div>
                        <div class="service-card bg-yellow-50 rounded-lg p-4 cursor-pointer transition-all duration-300"
                            data-service="career">
                            <h3 class="font-semibold text-yellow-800">Orientação Profissional</h3>
                            <p class="text-sm text-gray-600 mt-1">Auxílio na escolha e desenvolvimento de carreira.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3">

                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Novo Agendamento</h2>
                    <form id="appointment-form" method="POST">
                        <input type="hidden" id="selected-service-type" name="service-type" value="">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="client-name" class="block text-sm font-medium text-gray-700 mb-1">Nome do
                                    Cliente</label>
                                <input type="text" id="client-name" name="client-name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="client-email"
                                    class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                <input type="email" id="client-email" name="client-email"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="client-phone"
                                    class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <input type="tel" id="client-phone" name="client-phone"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="service-type"
                                    class="block text-sm font-medium text-gray-700 mb-1">Serviço</label>
                                <select id="service-type" name="service-type"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="">Selecione um serviço</option>
                                    <option value="individual">Psicoterapia Individual</option>
                                    <option value="couple">Psicoterapia de Casal</option>
                                    <option value="group">Grupo de Apoio para Bariátricas</option>
                                    <option value="lecture">Palestra</option>
                                    <option value="career">Orientação Profissional</option>
                                </select>
                            </div>
                            <div>
                                <label for="service-type"
                                    class="block text-sm font-medium text-gray-700 mb-1">Modalidade</label>
                                <select id="service-type"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="">Selecione um serviço</option>
                                    <option value="individual">Presencial</option>
                                    <option value="individual">Online</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="appointment-notes"
                                class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                            <textarea id="appointment-notes" name="appointment-notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-180 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                                Agendar
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Eventos</h2>
                        <div class="flex space-x-2">
                        </div>
                    </div>

                    <div id="appointments-list">

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Hoje</h3>
                            <div class="space-y-3">
                                <div class="border-l-4 border-indigo-500 pl-4 py-2 bg-indigo-50 rounded-r">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm text-gray-600">Psicoterapia Individual</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-gray-800">10:00 - 11:00</p>
                                            <p class="text-xs text-gray-500">Confirmado</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-l-4 border-pink-500 pl-4 py-2 bg-pink-50 rounded-r">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm text-gray-600">Psicoterapia de Casal</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-gray-800">14:00 - 15:30</p>
                                            <p class="text-xs text-gray-500">Confirmado</p>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Amanhã</h3>
                            <div class="space-y-3">
                                <div class="border-l-4 border-green-500 pl-4 py-2 bg-green-50 rounded-r">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800">Grupo de Apoio</h4>
                                            <p class="text-sm text-gray-600">Bariátricas - 5 participantes</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-gray-800">18:00 - 19:30</p>
                                            <p class="text-xs text-gray-500">Confirmado</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="week-appointments" class="hidden">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Esta Semana</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-medium text-gray-700 mb-2">17 de Junho, Quarta-feira</h4>
                                    <div class="border-l-4 border-yellow-500 pl-4 py-2 bg-yellow-50 rounded-r mb-3">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="text-sm text-gray-600">Orientação Profissional</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-medium text-gray-800">09:00 - 10:30</p>
                                                <p class="text-xs text-gray-500">Confirmado</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-700 mb-2">18 de Junho, Quinta-feira</h4>
                                    <div class="border-l-4 border-indigo-500 pl-4 py-2 bg-indigo-50 rounded-r mb-3">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-800">Patrícia Oliveira</h4>
                                                <p class="text-sm text-gray-600">Psicoterapia Individual</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-medium text-gray-800">11:00 - 12:00</p>
                                                <p class="text-xs text-gray-500">Confirmado</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-700 mb-2">19 de Junho, Sexta-feira</h4>
                                    <div class="border-l-4 border-purple-500 pl-4 py-2 bg-purple-50 rounded-r">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-800">Palestra Empresarial</h4>
                                                <p class="text-sm text-gray-600">Saúde Mental no Trabalho</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-medium text-gray-800">15:00 - 17:00</p>
                                                <p class="text-xs text-gray-500">Confirmado</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-3">Agendamento realizado!</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">O agendamento foi confirmado e um e-mail foi enviado para o
                        cliente.</p>
                </div>
                <div class="mt-4">
                    <button id="close-modal" type="button"
                        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calendar functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Current date
            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();

            // Notification dropdown toggle
            const notificationBtn = document.getElementById('notification-btn');
            const notificationDropdown = document.getElementById('notification-dropdown');

            notificationBtn.addEventListener('click', function () {
                notificationDropdown.classList.toggle('hidden');
            });

            // Close notification dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!notificationBtn.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });

            // View toggle (day/week)
            const viewDayBtn = document.getElementById('view-day');
            const viewWeekBtn = document.getElementById('view-week');
            const dayAppointments = document.querySelector('#appointments-list > div:not(#week-appointments)');
            const weekAppointments = document.getElementById('week-appointments');

            viewDayBtn.addEventListener('click', function () {
                dayAppointments.classList.remove('hidden');
                weekAppointments.classList.add('hidden');
                viewDayBtn.classList.remove('bg-gray-200', 'text-gray-700');
                viewDayBtn.classList.add('bg-indigo-600', 'text-white');
                viewWeekBtn.classList.remove('bg-indigo-600', 'text-white');
                viewWeekBtn.classList.add('bg-gray-200', 'text-gray-700');
            });

            viewWeekBtn.addEventListener('click', function () {
                dayAppointments.classList.add('hidden');
                weekAppointments.classList.remove('hidden');
                viewWeekBtn.classList.remove('bg-gray-200', 'text-gray-700');
                viewWeekBtn.classList.add('bg-indigo-600', 'text-white');
                viewDayBtn.classList.remove('bg-indigo-600', 'text-white');
                viewDayBtn.classList.add('bg-gray-200', 'text-gray-700');
            });

            // Calendar navigation
            const prevMonthBtn = document.getElementById('prev-month');
            const nextMonthBtn = document.getElementById('next-month');
            const currentMonthEl = document.getElementById('current-month');
            const calendarDays = document.getElementById('calendar-days');

            function renderCalendar() {
                // Clear previous calendar days
                calendarDays.innerHTML = '';

                // Set current month and year in header
                const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                currentMonthEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;

                // Get first day of month and total days in month
                const firstDay = new Date(currentYear, currentMonth, 1).getDay();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                // Get days from previous month
                const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

                // Add days from previous month
                for (let i = firstDay - 1; i >= 0; i--) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center py-2 text-gray-400';
                    dayElement.textContent = prevMonthDays - i;
                    calendarDays.appendChild(dayElement);
                }

                // Add days from current month
                const today = new Date();
                for (let i = 1; i <= daysInMonth; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center py-2 cursor-pointer calendar-day rounded-full hover:bg-gray-100';

                    // Highlight today
                    if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                        dayElement.classList.add('bg-indigo-100', 'font-medium');
                    }

                    dayElement.textContent = i;

                    // Add click event to select date
                    dayElement.addEventListener('click', function () {
                        // Remove selected class from all days
                        document.querySelectorAll('.calendar-day').forEach(day => {
                            day.classList.remove('bg-indigo-600', 'text-white');
                        });

                        // Add selected class to clicked day
                        this.classList.add('bg-indigo-600', 'text-white');

                        // Update selected date display
                        const selectedDate = new Date(currentYear, currentMonth, i);
                        const options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        document.getElementById('selected-date-time').textContent = selectedDate.toLocaleDateString('pt-BR', options);

                        // Limpa seleção de horário anterior ao mudar de data
                        document.getElementById('selected-date-time-input').value = '';

                        // Generate time slots for selected date
                        generateTimeSlots();
                    });

                    calendarDays.appendChild(dayElement);
                }

                // Calculate total cells (7 columns x 6 rows = 42)
                const totalCells = 42;
                const remainingCells = totalCells - (firstDay + daysInMonth);

                // Add days from next month
                for (let i = 1; i <= remainingCells; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'text-center py-2 text-gray-400';
                    dayElement.textContent = i;
                    calendarDays.appendChild(dayElement);
                }
            }

            // Previous month button
            prevMonthBtn.addEventListener('click', function () {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar();
            });

            // Next month button
            nextMonthBtn.addEventListener('click', function () {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar();
            });

            // Initial calendar render
            renderCalendar();

            // Time slots generation
            const timeSlotsContainer = document.getElementById('time-slots');
            const selectedDateTimeDisplay = document.getElementById('selected-date-time');

            // Adiciona evento para salvar o horário selecionado
            function generateTimeSlots() {
                // Limpa os horários anteriores
                timeSlotsContainer.innerHTML = '';

                // Gera horários das 8:00 às 18:00 com intervalos de 1 hora
                for (let hour = 8; hour <= 18; hour++) {
                    const timeSlot = document.createElement('button');
                    timeSlot.className = 'py-2 px-1 bg-white border border-gray-300 rounded-md text-sm hover:bg-indigo-50 hover:border-indigo-300 focus:outline-none focus:ring-1 focus:ring-indigo-500';

                    // Formata o horário (8:00, 9:00, etc.)
                    const timeString = `${hour}:00 - ${hour + 1}:00`;
                    timeSlot.textContent = timeString;

                    // Adiciona evento de clique para selecionar o horário
                    timeSlot.addEventListener('click', function () {
                        // Remove a classe selecionada de todos os horários
                        document.querySelectorAll('#time-slots button').forEach(slot => {
                            slot.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-700');
                        });

                        // Adiciona a classe selecionada ao horário clicado
                        this.classList.add('bg-indigo-600', 'text-white', 'border-indigo-700');

                        // Atualiza o horário selecionado no campo oculto e no texto exibido
                        const selectedDateEl = document.querySelector('.calendar-day.bg-indigo-600');
                        if (selectedDateEl) {
                            const day = parseInt(selectedDateEl.textContent);
                            const selectedDate = new Date(currentYear, currentMonth, day);
                            const options = {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }; // Formato AAAA-MM-DD
                            const dateString = selectedDate.toLocaleDateString('pt-BR', options);
                            const selectedTime = this.textContent.split(' - ')[0]; // Extrai a hora do texto do time slot
                            const dateTimeString = `${dateString} ${selectedTime}:00`; // Formato AAAA-MM-DD HH:MM:SS

                            selectedDateTimeDisplay.textContent = `${dateString} às ${selectedTime}`;

                            // Atualiza o valor do campo oculto
                            document.getElementById('selected-date-time-input').value = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate(), selectedTime.split(':')[0]).toISOString().slice(0, 19).replace('T', ' ');
                            console.log("Valor do campo oculto:", document.getElementById('selected-date-time-input').value);
                        }
                    });

                    timeSlotsContainer.appendChild(timeSlot);
                }
            }

            // Initial time slots generation
            generateTimeSlots();

            // Service selection
            const serviceCards = document.querySelectorAll('.service-card');
            const serviceSelect = document.getElementById('service-type');

            serviceCards.forEach(card => {
                card.addEventListener('click', function () {
                    // Remove selected class from all service cards
                    serviceCards.forEach(c => {
                        c.classList.remove('ring-2', 'ring-offset-2');
                        const serviceColor = c.dataset.service;
                        c.classList.remove(`ring-${getColor(serviceColor)}-500`);
                    });

                    // Add selected class to clicked card
                    const service = this.dataset.service;
                    this.classList.add('ring-2', 'ring-offset-2', `ring-${getColor(service)}-500`);

                    // Update service select dropdown
                    //serviceSelect.value = service;
                    document.getElementById('selected-service-type').value = service;
                });
            });

            // Helper function to get color based on service
            function getColor(service) {
                const colors = {
                    'individual': 'indigo',
                    'couple': 'pink',
                    'group': 'green',
                    'lecture': 'purple',
                    'career': 'yellow'
                };
                return colors[service] || 'indigo';
            }

            // Form submission
            const appointmentForm = document.getElementById('appointment-form');
            const successModal = document.getElementById('success-modal');
            const closeModalBtn = document.getElementById('close-modal');
            /*
                        appointmentForm.addEventListener('submit', function (e) {
                            e.preventDefault();
            
                            // Validate form
                            const clientName = document.getElementById('client-name').value;
                            const clientEmail = document.getElementById('client-email').value;
                            const serviceType = document.getElementById('service-type').value;
                            const selectedDateTime = document.getElementById('selected-date-time-input').value;
            
                            if ($enviado && empty($nomeErro) && empty($emailErro) && empty($websiteErro) && empty($generoErro)) {
                                alert Seus dados foram enviados! {
                                    echo "<h1>Dados enviados:</h1>";
                                    echo "<p><b>Nome: </b>" . $nome . "</p>";
                                    echo "<p><b>E-mail: </b>" . $email . "</p>";
                                    echo "<p><b>Celular: </b>" . $celular . "</p>";
                                    echo "<p><b>Observações: </b>" . $observacoes . "</p>";
                                    echo "<p><b>Serviço: </b>" . $genero . "</p>";');
                                return;
                            }
            
                            // In a real app, you would send this data to the server
                            console.log('Form submitted:', {
                                clientName,
                                clientEmail,
                                clientPhone: document.getElementById('client-phone').value,
                                serviceType,
                                appointmentNotes: document.getElementById('appointment-notes').value,
                                selectedDateTime
                            });
            
                            // Show success modal
                            successModal.classList.remove('hidden');
            
                            // Reset form
                            this.reset();
                            document.getElementById('selected-date-time').textContent = 'Nenhuma data/horário selecionado';
            
                            // Remove selections
                            document.querySelectorAll('.calendar-day, #time-slots button, .service-card').forEach(el => {
                                el.classList.remove('bg-indigo-600', 'text-white', 'ring-2', 'ring-offset-2', 'ring-indigo-500', 'ring-pink-500', 'ring-green-500', 'ring-purple-500', 'ring-yellow-500');
                            });
                        });
            */
            // Close modal
            closeModalBtn.addEventListener('click', function () {
                successModal.classList.add('hidden');
            });
        });
    </script>
</body>

</html>