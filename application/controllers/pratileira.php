<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pratileira extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("pratileira_model");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $dados = array(
                'todas_prateleiras' => $this->pratileira_model->obterTodasPrateleiras()->result()
            );



            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('pratileira/tabela_pratileira_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function nova_pratileira() {


        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $proxima_pratileira = 0;

            foreach ($this->pratileira_model->obterUltimaPratileira()->result() as $up) {
                $proxima_pratileira = $up->ultima_pratileira + 1;
            }

            $dados = array(
                'proxima_pratileira' => $proxima_pratileira,
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('pratileira/forme_nova_pratileira_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salva_pratileira() {

        $this->form_validation->set_rules('nomePratileira', 'Nome Pratileira', "required");

        if ($this->form_validation->run() == false) {
            foreach ($this->pratileira_model->obterUltimaPratileira()->result() as $up) {
                $proxima_pratileira = $up->ultima_pratileira + 1;
            }

            $dados = array(
                'proxima_pratileira' => $proxima_pratileira,
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('pratileira/forme_nova_pratileira_view', $dados);
            $this->load->view('tela/rodape');
        } else {

            $nome_pratileira = $_POST['nomePratileira'];

            $dados = array(
                'id_patileira' => '',
                'nome_patileira' => $nome_pratileira
            );

            $this->pratileira_model->salvarPratileira($dados)->result();

            redirect(base_url('pratileira'));
        }
    }

    public function alterar_prateleira() {

        $id_prateleira = $this->uri->segment(3);

        if (empty($id_prateleira)) {
            redirect(base_url('pratileira'));
        } else {
            $id_prateleira;
            $nome_prateleira;

            $query = $this->pratileira_model->obterUmaPrateleira($id_prateleira)->result();

            foreach ($query as $qr) {
                $id_prateleira = $qr->id_patileira;
                $nome_prateleira = $qr->nome_patileira;
            }

            $dados = array(
                'id_prateleira' => $id_prateleira,
                'nome_prateleira' => $nome_prateleira
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('pratileira/forme_alterar_pratileira_view', $dados);
                $this->load->view('tela/rodape');
        }
    }

    public function salva_pratileira_alterada() {
        $this->form_validation->set_rules('nomePratileira', 'Nome Pratileira', "required");
       
        $id_prateleira = $_POST['idPrateleira'];
        
        if ($this->form_validation->run() == false) {
            redirect('pratileira/alterar_prateleira/' . $id_prateleira);
        } else {

            $nome_pratileira = $_POST['nomePratileira'];

            $dados = array(
                'nome_patileira' => $nome_pratileira
            );

            $this->pratileira_model->salvarPratileiraAlterada($dados,$id_prateleira);

            redirect(base_url('pratileira'));
        }
    }

    public function excluir_prateleira() {

        $id_prateleira = $this->uri->segment(3);

        if (empty($id_prateleira)) {
            redirect(base_url('pratileira'));
        } else {

            $this->pratileira_model->excluirPratileira($id_prateleira);

            redirect(base_url('pratileira'));
        }
    }

}