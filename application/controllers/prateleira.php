<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prateleira extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("prateleira_model");
        $this->load->library("pagination");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {
           
            //Configurações da paginação de dados
            $config['base_url'] = base_url("prateleira/index");
            $config['total_rows'] = $this->prateleira_model->obterTodasPrateleiras()->num_rows(); 
            $config['per_page'] = 20;    
            $qtde = $config['per_page'];
            $inicio = (!$this->uri->segment(3)) ? 0 : $this->uri->segment(3);
            $this->pagination->initialize($config);
            
            $dados = array(
                'todas_prateleiras' => $this->prateleira_model->obterTodasPrateleiras($qtde,$inicio)->result(),
                'paginacao' => $this->pagination->create_links()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('prateleira/tabela_prateleira_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function nova_prateleira() {


        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('prateleira/forme_nova_prateleira_view');

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salva_prateleira() {

        $this->form_validation->set_rules('nomePrateleira', 'Nome Prateleira', "required");

        if ($this->form_validation->run() == false) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('prateleira/forme_nova_prateleira_view');
            $this->load->view('tela/rodape');
        } else {

            $nome_prateleira = $_POST['nomePrateleira'];

            $dados = array(
                'id_prateleira' => '',
                'nome_prateleira' => $nome_prateleira
            );

            $this->prateleira_model->salvarPrateleira($dados);
            $this->session->set_flashdata('sucesso','Prateleira, salva com sucesso!');
            redirect(base_url('prateleira'));
        }
    }

    public function alterar_prateleira() {

        $id_prateleira = $this->uri->segment(3);

        if (empty($id_prateleira)) {
            redirect(base_url('prateleira'));
        } else {
            $id_prateleira;
            $nome_prateleira;

            $query = $this->prateleira_model->obterUmaPrateleira($id_prateleira)->result();

            foreach ($query as $qr) {
                $id_prateleira = $qr->id_prateleira;
                $nome_prateleira = $qr->nome_prateleira;
            }

            $dados = array(
                'id_prateleira' => $id_prateleira,
                'nome_prateleira' => $nome_prateleira
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('prateleira/forme_alterar_prateleira_view', $dados);
            $this->load->view('tela/rodape');
        }
    }

    public function salva_prateleira_alterada() {
        $this->form_validation->set_rules('nomePrateleira', 'Nome Prateleira', "required");

        $id_prateleira = $_POST['idPrateleira'];

        if ($this->form_validation->run() == false) {
            redirect('prateleira/alterar_prateleira/' . $id_prateleira);
        } else {

            $nome_prateleira = $_POST['nomePrateleira'];

            $dados = array(
                'nome_prateleira' => $nome_prateleira
            );

            $this->prateleira_model->salvarPrateleiraAlterada($dados, $id_prateleira);
            $this->session->set_flashdata('sucesso','Prateleira, alterada com sucesso!');
            redirect(base_url('prateleira'));
        }
    }

    public function excluir_prateleira() {

        $id_prateleira = $this->uri->segment(3);

        if (!is_numeric($id_prateleira)) {
            redirect(base_url('prateleira'));
        } else {
            
            $qtde = $this->prateleira_model->verificarPrateleiraUtilisada($id_prateleira);
            
            if ($qtde == 0) {
                
                $this->prateleira_model->excluirPrateleira($id_prateleira);
                $this->session->set_flashdata('sucesso','Prateleira, excluída com sucesso!');
            }

             redirect(base_url('prateleira'));
        }
    }

}
