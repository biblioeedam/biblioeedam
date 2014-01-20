<?php


if (!defined('BASEPATH'))
    exit
            ('No direct script access allowed');

class funcionarios_controller extends CI_Controller {
        
    public function index()
	{
                $data['usuarios'] = $this->usuario_model->get_all();
		$this->load->view('main_view',$data);
		$this->load->view('funcionarios/funcionarios_view');
               
	}
    function cadastrar_funcionario(){
    }
    
    function apagar_funcionario(){
        
    }

}