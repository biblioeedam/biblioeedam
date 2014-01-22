<?php


if (!defined('BASEPATH'))
    exit
            ('No direct script access allowed');

class funcionarios extends CI_Controller {
        
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("funcionario_model");
    }
    
    function index(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {
            
            $dados = array(
                'todos_funcionarios' => $this->funcionario_model->obterTodosFuncionarios()->result()
            );
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('funcionarios/tabela_funcionarios_view',$dados);
            $this->load->view('tela/rodape');
        }else{
            redirect(base_url() . "seguranca");
        }
                   
    }
    
    public function novo_funcionario() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

           
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('funcionarios/forme_novo_funcionario_view');
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }
    
    function salva_funcionario(){
        $datos = array(
                    nome_funcionario => $this->input->post('nome'),
                    login_funcionario=> $this->input->post('login'),
                    senha_funcionario=> md5($this->input->post('senha'))
                    
                );
                
                if($this->funcionario_model->salvarFuncionario($datos)){
                    redirect('funcionarios');
                }
    }
    
        public function alterar_funcionario() {

        $id_funcionario = $this->uri->segment(3);

        if (empty($id_funcionario)) {
            redirect(base_url('funcionario'));
        } else {
            $id_funcionario;
            $nome_funcionario;

            $query = $this->funcionario_model->obterUmFuncionario($id_funcionario)->result();

            foreach ($query as $qr) {
                $id_funcionario = $qr->id_funcionario;
                $nome_funcionario = $qr->nome_funcionario;
                $login_funcionario = $qr->login_funcionario;
            }

            $dados = array(
                'id_funcionario' => $id_funcionario,
                'nome_funcionario' => $nome_funcionario,
                'login_funcionario' => $login_funcionario
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('funcionarios/forme_alterar_funcionario_view', $dados);
            $this->load->view('tela/rodape');
        }
    }
    
    public function salva_funcionario_alterado() {
       
            $id_funcionario = $_POST['idFuncionario'];

            $nome_funcionario = $_POST['nome'];

            $login_funcionario = $_POST['login'];
            
            $senha_funcionario = $_POST['senha'];
            $dados = array(
                'nome_funcionario' => $nome_funcionario,
                'login_funcionario' => $login_funcionario,
                'senha_funcionario' => md5($senha_funcionario)
            );

            $this->funcionario_model->salvarFuncionarioAlterado($dados, $id_funcionario);

            redirect(base_url('funcionarios'));
        
    }
    
    function excluir_funcionario(){
        $id_funcionario = $this->uri->segment(3);

        if (empty($id_funcionario)) {
            redirect(base_url('funcionarios'));
        } else {

            $this->funcionario_model->excluirFuncionario($id_funcionario);

            redirect(base_url('funcionarios'));
        }
        
    }

}