<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emprestimo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->model("emprestimo_model");
        $this->load->model("item_model");
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('UTC');
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {
 

            $dados = array(
                'todos_emprestimos' => $this->emprestimo_model->obterTodosEmprestimos()->result()
            );
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('emprestimo/tabela_emprestimo_view',$dados);
            $this->load->view('tela/rodape');
            
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    
    public function novo_emprestimo(){
        
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {
 
            $datestring = date('d/m/Y');
            $time = time();
            $dados = array(
                'dtAtual'=>mdate($datestring,$time),
                'tipos_item' => $this->emprestimo_model->obterTiposItem()->result(),
                'todos_itens' => $this->item_model->obterTodosItens()->result(),
            );
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('emprestimo/forme_novo_emprestimo_view',$dados);
            $this->load->view('tela/rodape');
            
        } else {
            redirect(base_url() . "seguranca");
        }
    }


    
    
    public function obter_nome_leitor() {
  
        
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {
              
           // $id_leitor = $_POST['id_leitor'];
            
           // $resultado = $this->emprestimo_model->obterNomeLeitor($id_leitor)->result();
           
            echo 'Hairton';
        } else {
          //  redirect(base_url() . "seguranca");
            echo 'ola';
        }
        
    }
    
    function liberar_emprestimo(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {
           
            $this->form_validation->set_rules('cod_leitor','Codigo do Leitor','required');
            $this->form_validation->set_rules('nome_leitor','Nome do Leitor','required');
            $this->form_validation->set_rules('dt_emprestimo','Data do Emprestimo','required');
            $this->form_validation->set_rules('dt_devolucao','Data de Devolução','required');
            $this->form_validation->set_rules('tipo_item','Tipo de Item','required');
            $this->form_validation->set_rules('cod_item','Codigo do Item','required');
            $this->form_validation->set_rules('vol_item','Volume', 'required');
            $this->form_validation->set_rules('nome_item','Nome do Item','required');
            
            if ($this->form_validation->run() == FALSE){
                $dados = array(
                    'dtAtual'=> date('d/m/Y'),
                    'tipos_item' => $this->emprestimo_model->obterTiposItem()->result()
                );
          
                $this->load->view('tela/titulo');
                $this->load->view('tela/menu_basico');
                $this->load->view('emprestimo/forme_novo_emprestimo_view',$dados);
                $this->load->view('tela/rodape');
            
            }else{
                $dados=array(
                    'data_acao'=>  date('Y-m-d'),
                    'dataDevolucao_acao'=>$this->input->post('dt_devolucao'),
                    'id_leitor'=>$this->input->post('cod_leitor'),
                    'id_funcionario'=>$this->session->userdata('id_funcionario'),
                    'id_tipo_acao'=>  $this->input->post('1')
                );
                
                $this->emprestimo_model->registraEmprestimo($dados);
            }
            
            
        }else{
            redirect(base_url() . "seguranca");
        }
               
    }
    
    function alterar_leitor(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {

        }else{
            redirect(base_url() . "seguranca");    
        }
    }
    

    
    
}

