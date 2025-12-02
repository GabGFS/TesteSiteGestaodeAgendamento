<?php
// Front-controller simples para o site (MVC)

require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/controllers/PagesController.php';
require_once __DIR__ . '/controllers/ClientesController.php';

// Roteamento: ?r=rota ou ?r=clientes/edit
$r = isset($_GET['r']) ? $_GET['r'] : 'home';
$parts = explode('/', $r);
$controller = $parts[0];
$action = isset($parts[1]) ? $parts[1] : null;

$pages = new PagesController();
$clientesCtrl = new ClientesController();

switch($controller) {
    case 'home':
        $pages->home();
        break;
    case 'sobremim':
        $pages->sobremim();
        break;
    case 'servicos':
        $pages->servicos();
        break;
    case 'perguntasfrequentes':
    case 'perguntas':
        $pages->perguntas();
        break;
    case 'meusagendamentos':
        $pages->meusagendamentos();
        break;
    case 'clientes':
        if ($action === 'edit') {
            $clientesCtrl->edit();
        } elseif ($action === 'delete') {
            $clientesCtrl->delete();
        } else {
            $clientesCtrl->index();
        }
        break;
    default:
        http_response_code(404);
        $pages->home();
        break;
}

// Inclui footer compartilhado em todas as rotas (conforme solicitado)
include __DIR__ . '/views/layout/footer.php';
?>