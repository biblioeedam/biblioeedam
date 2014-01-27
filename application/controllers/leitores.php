<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leitores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('leitores_model');
        $this->load->model('tipos_leitores_model');
        $this->load->helper('date');
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $dados = array(
                'todos_leitores' => $this->leitores_model->obterTodosLeitores()->result()
            );
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('leitores/tabela_leitores_view',$dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function novo_leitor() {
 
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {
            
            $tipos_leitores = array(
                'todos_tipos_leitores' => $this->tipos_leitores_model->obterTodosTiposLeitores()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('leitores/forme_novo_leitor_view',$tipos_leitores);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }
    
    function salvar_leitor(){
        $dados = array(
            'id_tipo_leitor' => $this->input->post('tipo_leitor'),
            'nome_leitor' => $this->input->post('nome_leitor'),
            'cpf_leitor' => $this->input->post('cpf_leitor'),
            'email_leitor' => $this->input->post('email_leitor'),
            'serie_leitor' => $this->input->post('serie_leitor'),
            'turno_leitor' => $this->input->post('turno_leitor'),
            'turma_leitor' => $this->input->post('turma_leitor'),
            'nomePai_leitor' => $this->input->post('nomePai_leitor'),
            'nomeMae_leitor' => $this->input->post('nomeMae_leitor'),  
            'telefone_leitor' => $this->input->post('telefone_leitor'),
            'dataCadastro_leitor' => date(),
            'status_leitor' => 1,
            'rua_residencia_leitor' => $this->input->post('rua_residencia_leitor'),
            'numero_residencia_leitor' => $this->input->post('numero_residencia_leitor'),
            'bairro_residencia_leitor' => $this->input->post('bairro_residencia_leitor'),
            'cidade_leitor' => $this->input->post('cidade_leitor'),
            'distrito_leitor' => $this->input->post('distrito_leitor'),
            'referencia_residencia_leitor' => $this->input->post('referencia_residencia_leitor'),
        );
        if($this->leitores_model->salvarLeitor($dados)){
            redirect('leitores');
        }        
    }
    
    function alterar_leitor(){
        
        $id_leitor = $this->uri->segment(3);
        
        if (empty($id_leitor)) {
            redirect(base_url('leitores'));
        } else {
            
            $tipos_leitores = array(
                'todos_tipos_leitores' => $this->tipos_leitores_model->obterTodosTiposLeitores()->result()
            );
            
            $query = $this->leitores_model->obterUmLeitor($id_leitor)->result();

            foreach ($query as $qr) {
                $id_leitor = $qr->id_leitor;
                $nome_leitor = $qr->nome_leitor;
                $cpf_leitor = $qr->cpf_leitor;
                $email_leitor = $qr->email_leitor;
                $serie_leitor = $qr->serie_leitor;
                $turno_leitor = $qr->turno_leitor;
                $turma_leitor = $qr->turma_leitor;
                $nomePai_leitor = $qr->nomePai_leitor;
                $nomeMae_leitor = $qr->nomeMae_leitor;  
                $telefone_leitor = $qr->telefone_leitor;
                $dataCadastro_leitor = $qr->dataCadastro_leitor;
                $rua_residencia_leitor = $qr->rua_residencia_leitor; 
                $numero_residencia_leitor = $qr->numero_residencia_leitor; 
                $bairro_residencia_leitor = $qr->bairro_residencia_leitor;
                $cidade_leitor = $qr->cidade_leitor;
                $distrito_leitor = $qr->distrito_leitor;
                $referencia_residencia_leitor = $qr->referencia_residencia_leitor;
            }

            $dados = array(
                'id_leitor' => $id_leitor,
                'nome_leitor' => $nome_leitor,
                'cpf_leitor' => $cpf_leitor,
                'email_leitor' => $email_leitor,
                'serie_leitor' => $serie_leitor,
                'turno_leitor' => $turno_leitor,
                'turma_leitor' => $turma_leitor,
                'nomePai_leitor' => $nomePai_leitor,
                'nomeMae_leitor' => $nomeMae_leitor,  
                'telefone_leitor' => $telefone_leitor,
                'dataCadastro_leitor' => $dataCadastro_leitor,
                'rua_residencia_leitor' => $rua_residencia_leitor,
                'numero_residencia_leitor' => $numero_residencia_leitor,
                'bairro_residencia_leitor' => $bairro_residencia_leitor,
                'cidade_leitor' => $cidade_leitor,
                'distrito_leitor' => $distrito_leitor,
                'referencia_residencia_leitor' => $referencia_residencia_leitor,
                'tipos_leitores' => $tipos_leitores
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('leitores/forme_alterar_leitor_view', $dados);
            $this->load->view('tela/rodape');
        }
    }
    
    function salvar_leitor_alterado(){
            
            $id_leitor = $this->input->post('id_leitor');
            $nome_leitor = $this->input->post('nome_leitor');
            $cpf_leitor = $this->input->post('cpf_leitor');
            $email_leitor = $this->input->post('email_leitor');
            $serie_leitor = $this->input->post('serie_leitor');
            $turno_leitor = $this->input->post('turno_leitor');
            $turma_leitor = $this->input->post('turma_leitor');
            $nomePai_leitor = $this->input->post('nomePai_leitor');
            $nomeMae_leitor = $this->input->post('nomeMae_leitor');  
            $telefone_leitor = $this->input->post('telefone_leitor');
            $rua_residencia_leitor = $this->input->post('rua_residencia_leitor');
            $numero_residencia_leitor = $this->input->post('numero_residencia_leitor');
            $bairro_residencia_leitor = $this->input->post('bairro_residencia_leitor');
            $cidade_leitor = $this->input->post('cidade_leitor');
            $distrito_leitor = $this->input->post('distrito_leitor');
            $referencia_residencia_leitor = $this->input->post('referencia_residencia_leitor');
            $dados = array(
                'nome_leitor' => $nome_leitor,
                'cpf_leitor' => $cpf_leitor,
                'email_leitor' => $email_leitor,
                'serie_leitor' => $serie_leitor,
                'turno_leitor' => $turno_leitor,
                'turma_leitor' => $turma_leitor,
                'nomePai_leitor' => $nomePai_leitor,
                'nomeMae_leitor' => $nomeMae_leitor,  
                'telefone_leitor' => $telefone_leitor,
                'rua_residencia_leitor' => $rua_residencia_leitor,
                'numero_residencia_leitor' => $numero_residencia_leitor,
                'bairro_residencia_leitor' => $bairro_residencia_leitor,
                'cidade_leitor' => $cidade_leitor,
                'distrito_leitor' => $distrito_leitor,
                'referencia_residencia_leitor' => $referencia_residencia_leitor,
            );

            $this->leitores_model->salvarLeitorAlterado($dados, $id_leitor);

            redirect(base_url('leitores'));
    }
            
    function excluir_leitor(){
        $id_leitor = $this->uri->segment(3);

        if (empty($id_leitor)) {
            redirect(base_url('leitores'));
        } else {

            $this->leitores_model->excluirLeitor($id_leitor);

            redirect(base_url('leitores'));
        }
    }
}

