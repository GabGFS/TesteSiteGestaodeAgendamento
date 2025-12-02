<?php
// Controller para clientes
include_once __DIR__ . '/../core/Controller.php';
include_once __DIR__ . '/../models/Cliente.php';
include_once __DIR__ . '/../core/Flash.php';
include_once __DIR__ . '/../core/Auth.php';

class ClientesController extends Controller {
    public function index() {
        $clients = Cliente::all();
        $this->render('clientes/index', ['clients' => $clients, 'title' => 'Clientes']);
    }

    public function create() {
        $created = false;
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome' => $_POST['nome'] ?? '',
                'email' => $_POST['email'] ?? '',
                'celular' => $_POST['celular'] ?? ''
            ];
            if (empty($data['nome'])) $errors[] = 'Nome é obrigatório';
            if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'E-mail inválido';

            if (empty($errors)) {
                $id = Cliente::create($data);
                if ($id) {
                    set_flash('success', 'Cliente criado com sucesso.');
                    header('Location: index.php?r=clientes');
                    exit;
                } else {
                    $errors[] = 'Erro ao criar cliente.';
                }
            }
            if (!empty($errors)) {
                set_flash('error', implode(' ', $errors));
            }
        }
        $this->render('clientes/create', ['created' => $created, 'errors' => $errors, 'title' => 'Novo Cliente']);
    }

    public function edit() {
        // Apenas administrador pode editar clientes
        require_role('admin');

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $client = Cliente::find($id);
        $updated = false;
        $error_message = '';

        if (!$client) {
            http_response_code(404);
            $this->render('404', ['title' => 'Cliente não encontrado']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome' => $_POST['nome'] ?? '',
                'email' => $_POST['email'] ?? '',
                'celular' => $_POST['celular'] ?? ''
            ];
            if (empty($data['nome'])) {
                $error_message = 'Preencha o campo nome';
                set_flash('error', $error_message);
            } else {
                $ok = Cliente::update($id, $data);
                if ($ok) {
                    set_flash('success', 'Cliente atualizado com sucesso.');
                    header('Location: index.php?r=clientes');
                    exit;
                } else {
                    $error_message = 'Erro ao atualizar cliente';
                    set_flash('error', $error_message);
                }
            }
        }

        $this->render('clientes/edit', ['client' => $client, 'updated' => $updated, 'error_message' => $error_message, 'title' => 'Editar Cliente']);
    }

    public function delete() {
        // Apenas administrador pode deletar clientes
        require_role('admin');

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $deleted = false;
        $client = Cliente::find($id);
        if (!$client) {
            http_response_code(404);
            $this->render('404', ['title' => 'Cliente não encontrado']);
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deleted = Cliente::delete($id);
            if ($deleted) {
                set_flash('success', 'Cliente deletado com sucesso.');
                header('Location: index.php?r=clientes');
                exit;
            } else {
                set_flash('error', 'Erro ao deletar cliente.');
            }
        }
        $this->render('clientes/delete', ['client' => $client, 'deleted' => $deleted, 'title' => 'Deletar Cliente']);
    }
}
