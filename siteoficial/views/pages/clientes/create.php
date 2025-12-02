<?php
// View: criar cliente
?>
<div class="card max-w-xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Novo Cliente</h1>

    <?php if (!empty($errors)): ?>
        <div class="mb-4 text-red-600">
            <?php foreach($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($created)): ?>
        <div class="mb-4 text-green-600">Cliente criado com sucesso. <a href="?r=clientes" class="text-indigo-600">Voltar à lista</a></div>
    <?php endif; ?>

    <form method="post" action="?r=clientes/create">
        <div class="mb-4">
            <label class="block font-medium">Nome</label>
            <input name="nome" class="w-full border rounded px-3 py-2" />
        </div>
        <div class="mb-4">
            <label class="block font-medium">E-mail</label>
            <input name="email" class="w-full border rounded px-3 py-2" />
        </div>
        <div class="mb-4">
            <label class="block font-medium">Celular</label>
            <input name="celular" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <button class="bg-green-500 text-white px-4 py-2 rounded">Criar cliente</button>
        </div>
    </form>
</div>