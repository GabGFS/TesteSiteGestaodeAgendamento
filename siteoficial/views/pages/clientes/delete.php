<?php
// View: deletar cliente
?>
<div class="card max-w-xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Deletar Cliente</h1>

    <?php if (!empty($deleted)): ?>
        <div class="mb-4 text-green-600">Cliente deletado com sucesso. <a href="?r=clientes" class="text-indigo-600">Voltar à lista</a></div>
    <?php else: ?>
        <p class="mb-4">Tem certeza que deseja deletar o cliente <strong><?= htmlspecialchars($client['nome'] ?? '') ?></strong> (ID <?= intval($client['id'] ?? 0) ?>)?</p>
        <form method="post" action="?r=clientes/delete&id=<?= intval($client['id'] ?? 0) ?>">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Sim, deletar</button>
            <a href="?r=clientes" class="ml-4 text-gray-700">Não</a>
        </form>
    <?php endif; ?>
</div>