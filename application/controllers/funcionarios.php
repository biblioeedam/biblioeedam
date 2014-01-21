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
    
    function cadastrar_funcionario(){
    }
    
    function apagar_funcionario(){
        
    }

}