<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="card w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-4 text-center">Faça login para acessar seus agendamentos</h1>
        <p class="text-gray-600 mb-6 text-center">Informe seu usuário e senha abaixo.</p>

        <form method="post" action="?r=login/validate" class="flex flex-col">
            <input type="text" name="username" placeholder="Usuário ou E-mail" class="border rounded px-3 py-2 mb-4" required />
            <input type="password" name="password" placeholder="Senha" class="border rounded px-3 py-2 mb-2" required />

            <div class="mb-4 text-right">
                <a href="?r=login/forgot" class="text-sm text-blue-600 hover:underline">Esqueci minha senha</a>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded font-medium">
                    Entrar
                </button>
            </div>
        </form>
    </div>
</div>
