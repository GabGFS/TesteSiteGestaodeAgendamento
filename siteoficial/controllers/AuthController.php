<?php
// Controller para autenticação
include_once __DIR__ . '/../core/Controller.php';
include_once __DIR__ . '/../models/User.php';
include_once __DIR__ . '/../core/Flash.php';
include_once __DIR__ . '/../core/Auth.php';

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = User::verifyPassword($email, $password);
            if ($user) {
                login_user($user);
                set_flash('success', 'Login efetuado com sucesso.');
                // redireciona para meus agendamentos por padrão
                header('Location: index.php?r=meusagendamentos');
                exit;
            } else {
                set_flash('error', 'Credenciais inválidas.');
            }
        }
        $this->render('auth/login', ['title' => 'Login']);
    }

    public function register() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'E-mail inválido';
            if (strlen($password) < 6) $errors[] = 'Senha deve ter ao menos 6 caracteres';
            if ($password !== $password2) $errors[] = 'Senhas não conferem';
            if (User::findByEmail($email)) $errors[] = 'E-mail já cadastrado';

            if (empty($errors)) {
                $created = User::create(['email' => $email, 'password' => $password, 'role' => 'client']);
                if ($created) {
                    set_flash('success', 'Cadastro realizado. Faça login.');
                    header('Location: index.php?r=auth/login');
                    exit;
                } else {
                    $errors[] = 'Erro ao criar usuário';
                }
            }
        }
        $this->render('auth/register', ['errors' => $errors, 'title' => 'Cadastrar']);
    }

    public function logout() {
        logout_user();
        set_flash('success', 'Você saiu da conta.');
        header('Location: index.php');
        exit;
    }
}
