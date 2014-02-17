<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        //Verifica a sessão do usuario, o privilégio de usuario normal e se está ativo
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1) && ($this->session->userdata('privilegio_funcionario')==1)) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('tela/inicio_view');
            $this->load->view('tela/rodape');
            
        //Verifica a sessão do usuario, o privilégio de super usuario e se está ativo    
        }elseif (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1) && ($this->session->userdata('privilegio_funcionario')==2)) {
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('tela/inicio_view');
            $this->load->view('tela/rodape');
            
        }else {
            redirect(base_url() . "seguranca");
        }
    }
}