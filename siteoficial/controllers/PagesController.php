<?php
// Controller para páginas estáticas
include_once __DIR__ . '/../core/Controller.php';

class PagesController extends Controller {
    protected function commonData() {
        return [
            'notifications' => [
                ["icon" => "fas fa-calendar-check", "color" => "blue", "message" => "Novo agendamento confirmado", "time" => "15 minutos atrás"],
                ["icon" => "fas fa-exclamation-triangle", "color" => "yellow", "message" => "Lembrete: Consulta amanhã às 10h", "time" => "2 horas atrás"],
                ["icon" => "fas fa-envelope", "color" => "green", "message" => "E-mail enviado para cliente", "time" => "Ontem"]
            ]
        ];
    }

    public function home() {
        $data = $this->commonData();
        $data['title'] = 'Início - Psicóloga Waldirene Paulino';
        $this->render('home', $data);
    }

    public function sobremim() {
        $data = $this->commonData();
        $data['title'] = 'Sobre mim - Psicóloga Waldirene Paulino';
        $this->render('sobremim', $data);
    }

    public function servicos() {
        $data = $this->commonData();
        $data['title'] = 'Serviços - Psicóloga Waldirene Paulino';
        $this->render('servicos', $data);
    }

    public function perguntas() {
        $data = $this->commonData();
        $data['title'] = 'Perguntas Frequentes';
        $this->render('perguntasfrequentes', $data);
    }

    public function meusagendamentos() {
        $data = $this->commonData();
        $data['title'] = 'Meus Agendamentos';
        $this->render('meusagendamentos', $data);
    }
}
