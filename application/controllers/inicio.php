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

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('tela/inicio_view');

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }
}