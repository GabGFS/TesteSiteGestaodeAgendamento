<?php
// Array com perguntas e respostas dinâmicas
$faq = [
    [
        "pergunta" => "Como é a primeira sessão?",
        "resposta" => "Na primeira sessão, o foco será compreender o motivo da sua busca pela psicoterapia, de forma respeitosa e acolhedora. Você pode conversar à vontade e responder algumas perguntas."
    ],
    [
        "pergunta" => "Onde ocorrem as sessões?",
        "resposta" => "As sessões são presenciais, em consultório, ou online, via plataforma segura."
    ],
    [
        "pergunta" => "Quanto tempo dura o tratamento?",
        "resposta" => "A duração do tratamento varia de acordo com a demanda e evolução de cada paciente."
    ],
    [
        "pergunta" => "Como agendar atendimento?",
        "resposta" => 'O agendamento é realizado através deste site. <a href="index.php?param=home" class="link-agendamento">Clique aqui</a> para ser redirecionado para a página de agendamento.'
    ],
    [
        "pergunta" => "Como funciona o sigilo terapêutico?",
        "resposta" => "Todo o conteúdo das sessões é sigiloso, conforme o código de ética profissional do Psicólogo."
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas Frequentes | Psicóloga Waldirene Paulino</title>
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

        /* Estilos específicos do FAQ (mantidos) */
        body.faq-body {
          background-color: #e0d5c8;
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .faq-container {
          max-width: 700px;
          margin: 40px auto;
          background: #fff;
          border-radius: 12px;
          padding: 30px 40px;
          box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .faq-title {
          font-size: 2.4rem;
          text-align: center;
          margin-bottom: 30px;
          color: #1f2f29;
        }
        .faq-item {
          border-bottom: 1px solid #ddd;
          padding: 20px 0;
        }
        .faq-question {
          font-weight: 600;
          font-size: 1.2rem;
          color: #2a5d34;
          margin-bottom: 10px;
        }
        .faq-answer {
          font-size: 1rem;
          color: #444;
          line-height: 1.5;
          max-height: 80px;
          overflow: hidden;
          transition: max-height 0.5s ease, padding 0.5s ease, font-size 0.3s ease;
/* Removi o cursor pointer para não mostrar a mãozinha */
          cursor: default;
          padding-right: 10px;
/* Removi a borda esquerda */
          border-left: none;
        }
        .faq-answer.expanded {
          max-height: 500px;
/* Removi a borda verde também */
     /* Removi o cursor point/* Removi a borda esquerda */
er para não mostrar a mãozinha */
          border-left: none;
          padding-left: 0;
        }

        .faq-answer:hover {
          font-size: 1.15rem;
        }
        .link-agendampoint/* Removi a borda esquerda */
er                color: #3ca24d;
          font/* Removi a borda verde também */
     /* Removi o cursor pointer para não mostrar a mãozinha */
-weight: 700;
          text-decoration: underline;
        }
        .link-agendamento:hover {
          color: #2a5d34;
        }
    </style>
</head>

<body class="faq-body bg-gray-50 font-sans">
    <header class="bg-indi/* Removi a borda verde também */
     /* Removi o cursor pointer para não mostrar a mãozinha */
go-700 text-white shadow-lg" style="background-color:rgb(182, 233, 188)" ;>
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
        <!-- FAQ content -->
        <div class="faq-container">
          <h2 class="faq-title">Perguntas Frequentes</h2>

          <?php foreach ($faq as $index => $item): ?>
            <div class="faq-item">
              <div class="faq-question">
                <?= htmlspecialchars($item['pergunta']) ?>
              </div>
              <div class="faq-answer" data-index="<?= $index ?>">
                <?= $item['resposta'] ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
    </main>

<script>
  document.querySelectorAll('.faq-answer').forEach(answer => {
    answer.addEventListener('click', () => {
      answer.classList.toggle('expanded');
    });
  });

  // Notification dropdown toggle (mesmo comportamento do index)
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
