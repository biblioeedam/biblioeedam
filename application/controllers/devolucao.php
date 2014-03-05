<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Devolucao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->model("emprestimo_model");
        $this->load->model("item_model");
        $this->load->model("leitores_model");
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('UTC');
        $this->load->library("pagination");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario') == 1)) {

            //Configurações da paginação de dados
            $config['base_url'] = base_url("devolucao/index");
            $config['total_rows'] = $this->emprestimo_model->obterTodosEmprestimos()->num_rows(); 
            $config['per_page'] = 20;    
            $qtde = $config['per_page'];
            $inicio = (!$this->uri->segment(3)) ? 0 : $this->uri->segment(3);
            $this->pagination->initialize($config);
            
            //verifica se exite valor no campo de busca na tabela de devoluções 
            $nome_leitor = $this->input->post('nome_leitor');
            if(!empty($nome_leitor)){ 
                $dados = array(
                    'todos_emprestimos' => $this->emprestimo_model->obterUmEmprestimo($nome_leitor)->result(),
                );
            }else{
                $dados = array(
                    'todos_emprestimos' => $this->emprestimo_model->obterTodosEmprestimos($qtde,$inicio)->result(),
                    'paginacao' => $this->pagination->create_links(),
                );
            }
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('devolucao/tabela_devolucao_view', $dados);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function emprestimo() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario') == 1)) {
            $id_acao = $this->uri->segment(3);

            if (is_numeric($id_acao)) {

                $query_emprestimo = $this->emprestimo_model->obterEmprestimoSelecionado($id_acao)->result();
                $emprestimo = get_object_vars($query_emprestimo[0]);
                $query_itens = $this->emprestimo_model->obterItemAcaoEntrestimo($emprestimo['id_acao'])->result();


                $dados = array(
                    'emprestimo' => $query_emprestimo,
                    'itens_emprestimo' => $query_itens,
                );


                $this->load->view('tela/titulo');
                $this->load->view('tela/menu_basico');
                $this->load->view('devolucao/emprestimo_selecionado_view', $dados);
                $this->load->view('tela/rodape');
            } else {
                redirect(base_url("devolucao/"));
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function receber() {
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario') == 1)) {

            $url = $this->uri->uri_to_assoc(3);

            $id_item = $url['item'];
            $id_acao = $url['emprestimo'];

            if ((is_numeric($id_item)) && (is_numeric($id_acao))) {

                $dados = array(
                    'status' => 0,
                );

                $this->emprestimo_model->excluirItemEmprestado($dados, $id_acao, $id_item);
                
                $qtde = $this->emprestimo_model->obterQuantidadeItemEmprestadoPorAcao($id_acao);
                if ($qtde <= 0) {

                    $dados = array(
                        'id_tipo_acao' => 2,
                    );
                    $this->emprestimo_model->excluirEmprestimo($dados, $id_acao);
                    redirect(base_url("devolucao/"));
                } else {
                    redirect(base_url("devolucao/emprestimo/" . $id_acao));
                };
            } else {
                redirect(base_url("devolucao/"));
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

}

