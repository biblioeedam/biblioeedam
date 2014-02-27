<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Relatorios extends CI_Controller {
    
     public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->model('leitores_model');
        $this->load->model('tipos_leitores_model');        
        $this->load->library('form_validation');
        $this->load->helper('date');
    }
    
    public function tabela_leitores_pendentes(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1) && ($this->session->userdata('privilegio_funcionario')==2)) {            

            $dados = array(
                'leitores_pendentes' => $this->leitores_model->obterLeitoresPendentes()->result()
            );
           
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('relatorios/relatorio_emprestimo/tabela_leitores_pendentes_view',$dados);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }
    
    //Obtem uma lista de de itens atrasados pelo Leitor
    public function lista_itens_atrasados(){
         if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1) && ($this->session->userdata('privilegio_funcionario')==2)) {            

            $id_leitor = 1;

            $dados = array(
                'itens_atrasados' => $this->leitores_model->obterItensAtrasados($id_leitor)->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('relatorios/relatorio_emprestimo/tabela_leitores_pendentes_view',$dados);
            $this->load->view('tela/rodape');
         }else{
            redirect(base_url() . "seguranca");
         }   
        
    }

    public function busca_leitor(){
        
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1) && ($this->session->userdata('privilegio_funcionario')==2)) {            
           
            //verifica se exite valor no campo de busca na tabela de leitores 
            $nome_leitor = $this->input->post('nome_busca_leitor');
            if(!empty($nome_leitor)){
                $dados = array(
                    'todos_leitores' => $this->leitores_model->obterUmLeitor2($nome_leitor)->result()
                );
                $this->load->view('tela/titulo');
                $this->load->view('tela/menu');
                $this->load->view('relatorios/relatorio_dados_leitor/busca_leitor_view',$dados);
                $this->load->view('tela/rodape');
            }else{    
                $this->load->view('tela/titulo');
                $this->load->view('tela/menu');
                $this->load->view('relatorios/relatorio_dados_leitor/busca_leitor_view');
                $this->load->view('tela/rodape');
            }
            
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function dados_leitor(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1) && ($this->session->userdata('privilegio_funcionario')==2)) {
            $id_leitor = $this->uri->segment(3);

            if (empty($id_leitor)) {
                redirect(base_url('leitores'));
            } else {

                

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
                    $rua_residencia_leitor = $qr->rua_residencia_leitor; 
                    $numero_residencia_leitor = $qr->numero_residencia_leitor; 
                    $bairro_residencia_leitor = $qr->bairro_residencia_leitor;
                    $cidade_leitor = $qr->cidade_leitor;
                    $distrito_leitor = $qr->distrito_leitor;
                    $referencia_residencia_leitor = $qr->referencia_residencia_leitor;
                    $id_tipo_leitor = $qr->id_tipo_leitor;
                }
                
                $tipo_leitor = $this->tipos_leitores_model->obterTipoLeitor($id_tipo_leitor)->result();
             
                foreach ($tipo_leitor as $tp){
                    $nome_tipo_leitor = $tp->nome_tipo_leitor;
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
                    'rua_residencia_leitor' => $rua_residencia_leitor,
                    'numero_residencia_leitor' => $numero_residencia_leitor,
                    'bairro_residencia_leitor' => $bairro_residencia_leitor,
                    'cidade_leitor' => $cidade_leitor,
                    'distrito_leitor' => $distrito_leitor,
                    'referencia_residencia_leitor' => $referencia_residencia_leitor,
                    'nome_tipo_leitor' => $nome_tipo_leitor
                );

                $this->load->view('tela/titulo');
                $this->load->view('tela/menu');
                $this->load->view('relatorios/relatorio_dados_leitor/relatorio_dados_leitor_view', $dados);
                $this->load->view('tela/rodape');
            }
        }else{
            redirect(base_url() . "seguranca");    
        }
    }
    
    
    
}