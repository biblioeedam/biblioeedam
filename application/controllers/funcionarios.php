<?php

if (!defined('BASEPATH'))
    exit
            ('No direct script access allowed');

class Funcionarios extends CI_Controller {       
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("funcionario_model");
        $this->load->model("privilegios_model");
    }

    function index() {
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $dados = array(
                'todos_funcionarios' => $this->funcionario_model->obterTodosFuncionarios()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('funcionarios/tabela_funcionarios_view', $dados);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function novo_funcionario() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $dados = array('todos_privilegios' => $this->privilegios_model->obterTodosPrivilegios()->result());

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('funcionarios/forme_novo_funcionario_view', $dados);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    function salva_funcionario() {
    
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('senha2', 'Confirmação de Senha', 'required|matches[senha]'); 
        
        if ($this->form_validation->run() == FALSE){
            
            $dados = array('todos_privilegios' => $this->privilegios_model->obterTodosPrivilegios()->result());
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('funcionarios/forme_novo_funcionario_view',$dados);
            $this->load->view('tela/rodape');
            
        }else{
            $dados = array(
                        'nome_funcionario' => $this->input->post('nome'),
                        'login_funcionario' => $this->input->post('login'),
                        'senha_funcionario' => md5($this->input->post('senha')),
                        'id_privilegio' => $this->input->post('tipoPermissao'),
                        'status_funcionario' => '1'
                    );
                
            if($this->funcionario_model->salvarFuncionario($dados)){
                redirect('funcionarios');
            }
        }
    }

    public function alterar_funcionario() {

        $id_funcionario = $this->uri->segment(3);

        if (empty($id_funcionario)) {
            redirect(base_url('funcionario'));
        } else {

            $query = $this->funcionario_model->obterUmFuncionario($id_funcionario)->result();
            $privilegios = array('todos_privilegios' => $this->privilegios_model->obterTodosPrivilegios()->result());
            
            foreach ($query as $qr) {
                $id_funcionario = $qr->id_funcionario;
                $nome_funcionario = $qr->nome_funcionario;
                $login_funcionario = $qr->login_funcionario;
            }

            $dados = array(
                'id_funcionario' => $id_funcionario,
                'nome_funcionario' => $nome_funcionario,
                'login_funcionario' => $login_funcionario,
                'dadosPrivilegios' => $privilegios
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('funcionarios/forme_alterar_funcionario_view', $dados);
            $this->load->view('tela/rodape');
        }
    }

    //Função que exclui funcionario logicamente
    public function salva_funcionario_alterado() {

            $this->form_validation->set_rules('senha', 'Senha', 'required|matches[senha2]');
            $this->form_validation->set_rules('senha2', 'Confirmação de Senha', 'required'); 
        
            if ($this->form_validation->run() == FALSE){
                $dados = array('todos_privilegios' => $this->privilegios_model->obterTodosPrivilegios()->result());
                $this->load->view('tela/titulo');
                $this->load->view('tela/menu');
                $this->load->view('funcionarios/forme_novo_funcionario_view',$dados);
                $this->load->view('tela/rodape');
            }else{    
                $id_funcionario = $_POST['idFuncionario'];

                $nome_funcionario = $_POST['nome'];

                $id_funcionario = $_POST['idFuncionario'];

                $login_funcionario = $_POST['login'];

                $nome_funcionario = $_POST['nome'];

                $senha_funcionario = $_POST['senha'];
                
                $tipoPermissao = $_POST['tipoPermissao'];
                
                $dados = array(
                    'nome_funcionario' => $nome_funcionario,
                    'login_funcionario' => $login_funcionario,
                    'senha_funcionario' => md5($senha_funcionario),
                    'id_privilegio' => $tipoPermissao
                );

                $login_funcionario = $_POST['login'];

                $this->funcionario_model->salvarFuncionarioAlterado($dados, $id_funcionario);

                redirect(base_url('funcionarios'));
            }
        

        $senha_funcionario = $_POST['senha'];
        $dados = array(
            'nome_funcionario' => $nome_funcionario,
            'login_funcionario' => $login_funcionario,
            'senha_funcionario' => md5($senha_funcionario)
        );

        $this->funcionario_model->salvarFuncionarioAlterado($dados, $id_funcionario);

        redirect(base_url('funcionarios'));

    }

    function excluir_funcionario() {

        $id_funcionario = $this->uri->segment(3);

        //Paramento de funcionarios inativo(i)
        $dados = array(
            'status_funcionario' => 'i'
        );

        if (empty($id_funcionario)) {
            redirect(base_url('funcionarios'));
        } else {

            $this->funcionario_model->excluirFuncionario($dados, $id_funcionario);

            redirect(base_url('funcionarios'));
        }
    }

}
