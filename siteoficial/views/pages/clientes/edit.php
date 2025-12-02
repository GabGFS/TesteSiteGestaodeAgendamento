<?php
// View: editar cliente
?>
<div class="card max-w-xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Editar Cliente</h1>

    <?php if (!empty($error_message)): ?>
        <div class="mb-4 text-red-600"><b><?= htmlspecialchars($error_message) ?></b></div>
    <?php endif; ?>

    <?php if (!empty($updated)): ?>
        <div class="mb-4 text-green-600"><b>Cliente atualizado com sucesso!</b></div>
    <?php endif; ?>

    <form method="post" action="?r=clientes/edit&id=<?= intval($client['id'] ?? 0) ?>">
        <div class="mb-4">
            <label class="block font-medium">Nome</label>
            <input name="nome" value="<?= htmlspecialchars($client['nome'] ?? '') ?>" class="w-full border rounded px-3 py-2" />
        </div>
        <div class="mb-4">
            <label class="block font-medium">E-mail</label>
            <input name="email" value="<?= htmlspecialchars($client['email'] ?? '') ?>" class="w-full border rounded px-3 py-2" />
        </div>
        <div class="mb-4">
            <label class="block font-medium">Celular</label>
            <input name="celular" value="<?= htmlspecialchars($client['celular'] ?? '') ?>" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <button class="bg-green-500 text-white px-4 py-2 rounded">Salvar Cliente</button>
            <a href="?r=clientes" class="ml-4 text-gray-700">Cancelar</a>
        </div>
    </form>
</div>