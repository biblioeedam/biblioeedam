<?php


if (!defined('BASEPATH'))
    exit
            ('No direct script access allowed');

class funcionarios extends CI_Controller {
        
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('funcionario_model');
    }
    
    function index(){
        $this->load->view('tela/titulo');
        $this->load->view('tela/menu');
        $this->load->view('tela/inicio_view');
        $this->load->view('tela/rodape');
        $data['funcionario'] = $this->funcionario_model->obterTodosFuncionarios();
        $this->load->view('funcionarios/funcionarios_view',$data);
                   
    }
    
    function cadastrarFuncionario(){
        $datos = array(
                    nome_funcionario => $this->input->post('nome'),
                    login_funcionario=> $this->input->post('login'),
                    senha_funcionario=> $this->input->post('senha')
                    
                );
                if($this->funcionario_model->cadastrarFuncionario($datos)){
                    redirect('funcionarios');
                }
    }
    
    function apagarFuncionario(){
        if($this->funcionario_model->apagarFuncionario()){
          redirect('funcionarios');
        }else{
          die('Maiko Thadeu Erro');
        }
        
    }

}