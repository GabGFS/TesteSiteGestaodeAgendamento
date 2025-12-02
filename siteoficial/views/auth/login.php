<?php
// view: auth/login.php
?>
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-semibold mb-4">Login</h2>

  <form method="post" action="?r=auth/login">
    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700">E-mail</label>
      <input name="email" type="email" required class="w-full border rounded px-3 py-2" />
    </div>
    <div class="mb-2 relative">
      <label class="block text-sm font-medium text-gray-700">Senha</label>
      <input id="password-field" name="password" type="password" required class="w-full border rounded px-3 py-2" />
      <button type="button" id="toggle-password" class="absolute right-2 top-8 text-gray-500">👁️</button>
    </div>
    <div class="flex justify-between items-center mb-4">
      <a href="#" class="text-sm text-gray-500">Esqueci a minha senha</a>
      <a href="?r=auth/register" class="text-sm text-gray-700">Cadastrar</a>
    </div>

    <div class="flex justify-end">
      <button class="bg-green-500 text-white px-4 py-2 rounded">Entrar</button>
    </div>
  </form>
</div>

<script>
document.getElementById('toggle-password').addEventListener('click', function () {
  const f = document.getElementById('password-field');
  if (f.type === 'password') {
    f.type = 'text';
    this.textContent = '🙈';
  } else {
    f.type = 'password';
    this.textContent = '👁️';
  }
});
</script>