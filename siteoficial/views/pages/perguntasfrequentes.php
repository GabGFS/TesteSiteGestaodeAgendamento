<?php
$faq = [
    ["pergunta" => "Como é a primeira sessão?", "resposta" => "Na primeira sessão, o foco será compreender o motivo da sua busca pela psicoterapia, de forma respeitosa e acolhedora."],
    ["pergunta" => "Onde ocorrem as sessões?", "resposta" => "As sessões são presenciais, em consultório, ou online, via plataforma segura."],
    ["pergunta" => "Quanto tempo dura o tratamento?", "resposta" => "A duração do tratamento varia de acordo com a demanda e evolução de cada paciente."],
    ["pergunta" => "Como agendar atendimento?", "resposta" => 'O agendamento é realizado através deste site. <a href="index.php" class="link-agendamento">Clique aqui</a> para iniciar.' ],
    ["pergunta" => "Como funciona o sigilo terapêutico?", "resposta" => "Todo o conteúdo das sessões é sigiloso, conforme o código de ética profissional do Psicólogo."]
];
?>

<div class="faq-container max-w-3xl mx-auto bg-white rounded-lg p-6 shadow">
  <h2 class="text-2xl font-bold text-green-700 mb-4">Perguntas Frequentes</h2>
  <?php foreach ($faq as $index => $item): ?>
    <div class="mb-4 border-b pb-3">
      <div class="font-semibold text-green-800"><?= htmlspecialchars($item['pergunta']) ?></div>
      <div class="text-gray-700 mt-2 faq-answer"><?= $item['resposta'] ?></div>
    </div>
  <?php endforeach; ?>
</div>

<script>
document.querySelectorAll('.faq-answer').forEach(a => { a.addEventListener('click', () => a.classList.toggle('expanded')); });
</script>