<?php
// Lista de clientes (view)
?>
<div class="card">
    <h1 class="text-2xl font-semibold mb-4">Clientes</h1>
    <a href="?r=clientes/create" class="inline-block mb-4 bg-green-500 text-white px-4 py-2 rounded">Novo Cliente</a>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">E-mail</th>
                    <th class="px-4 py-2">Celular</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clients)): ?>
                    <tr><td colspan="5" class="px-4 py-2">Nenhum cliente cadastrado.</td></tr>
                <?php else: ?>
                    <?php foreach ($clients as $c): ?>
                        <tr>
                            <td class="border-t px-4 py-2"><?= htmlspecialchars($c['id']) ?></td>
                            <td class="border-t px-4 py-2"><?= htmlspecialchars($c['nome']) ?></td>
                            <td class="border-t px-4 py-2"><?= htmlspecialchars($c['email']) ?></td>
                            <td class="border-t px-4 py-2"><?= htmlspecialchars($c['celular']) ?></td>
                            <td class="border-t px-4 py-2">
                                <a class="text-indigo-600 mr-3" href="?r=clientes/edit&id=<?= $c['id'] ?>">Editar</a>
                                <a class="text-red-600" href="?r=clientes/delete&id=<?= $c['id'] ?>">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>