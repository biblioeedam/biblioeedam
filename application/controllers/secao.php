<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of secao
 *
 * @author hairton
 */
class secao extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("secao_model");
        $this->load->model("prateleira_model");
        $this->load->library("pagination");
    }

    public function index() {
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            //Configurações da paginação de dados
            $config['base_url'] = base_url("secao/index");
            $config['total_rows'] = $this->secao_model->obterTodasSecoes()->num_rows(); 
            $config['per_page'] = 20;    
            $qtde = $config['per_page'];
            $inicio = (!$this->uri->segment(3)) ? 0 : $this->uri->segment(3);
            $this->pagination->initialize($config);
            
            $prateleiras = '';

            $todas_secoes = array();
            foreach ($this->secao_model->obterTodasSecoes($qtde,$inicio)->result() as $td) {
                $query = $this->secao_model->obterPrateleirasPorSecao($td->id_secao)->result();
                foreach ($query as $qy) {
                    $prateleiras = $prateleiras . '<button class="btn btn-default">' . $qy->nome_prateleira . '</button>';
                }
                $td->prateleiras = $prateleiras;
                $todas_secoes[] = $td;
                $prateleiras = '';
            }

            $dados = array(
                'todas_secoes' => $todas_secoes,
                'paginacao' => $this->pagination->create_links(),
            );


            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('secao/tabela_secao_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function nova_secao() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $dados = array(
                'todas_prateleiras' => $this->prateleira_model->obterTodasPrateleiras()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('secao/forme_nova_secao_view', $dados);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salvar_secao() {

        $this->form_validation->set_rules("nomeSecao", "Nome Seção", "trim|required");
        $this->form_validation->set_rules("prateleiras", "Prateleira", "required");
        if ($this->form_validation->run() == false) {

            $dados = array(
                'todas_prateleiras' => $this->prateleira_model->obterTodasPrateleiras()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('secao/forme_nova_secao_view', $dados);
            $this->load->view('tela/rodape');
        } else {

            $nome_secao = $_POST['nomeSecao'];
            $prateleiras = $_POST['prateleiras'];
            $id_secao;

            $dados = array(
                'id_secao' => '',
                'nome_secao' => $nome_secao,
            );

            $query = $this->secao_model->salvarNovaSecao($dados)->result();


            foreach ($query as $qr) {
                $id_secao = $qr->secao_inserida;
            }

            $dados_secao_prateleira = array();


            foreach ($prateleiras as $p => $prateleira) {
                $dados_secao_prateleira[] = array(
                    'id_secao' => $id_secao,
                    'id_prateleira' => $prateleira
                );
            }

            $this->secao_model->salvarSecaoPrateleira($dados_secao_prateleira);

            redirect(base_url("secao"));
        }
    }

    public function alterar_secao() {
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $id_secao = $this->uri->segment(3);

            if (empty($id_secao)) {
                redirect(base_url("secao"));
            } else {


                $dados = array(
                    'secao_alterar' => $this->secao_model->obterUmaSecao($id_secao)->result(),
                    'todas_prateleiras' => $this->prateleira_model->obterTodasPrateleiras()->result(),
                    'prateleiras_secao' => $this->secao_model->obterPrateleirasPorSecao($id_secao)->result()
                );

                $this->load->view('tela/titulo');
                $this->load->view('tela/menu');
                $this->load->view('secao/forme_alterar_secao_view', $dados);
                $this->load->view('tela/rodape');
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salvar_secao_alterada() {
        $this->form_validation->set_rules("nomeSecao", "Nome Seção", "trim|required");
        $this->form_validation->set_rules("prateleiras", "Prateleira", "required");
        $id_secao = $_POST['idSecao'];
        if ($this->form_validation->run() == false) {

            $dados = array(
                'secao_alterar' => $this->secao_model->obterUmaSecao($id_secao)->result(),
                'todas_prateleiras' => $this->prateleira_model->obterTodasPrateleiras()->result(),
                'prateleiras_secao' => $this->secao_model->obterPrateleirasPorSecao($id_secao)->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('secao/forme_alterar_secao_view', $dados);
            $this->load->view('tela/rodape');
        } else {

            $nome_secao = $_POST['nomeSecao'];
            $prateleiras = $_POST['prateleiras'];

            $dados = array(
                'nome_secao' => $nome_secao,
            );

            $query = $this->secao_model->salvarSecaoAlterada($dados, $id_secao);


            $this->secao_model->excluirSecaoPrateleira($id_secao);

            $dados_secao_prateleira = array();

            foreach ($prateleiras as $p => $prateleira) {
                $dados_secao_prateleira[] = array(
                    'id_secao' => $id_secao,
                    'id_prateleira' => $prateleira
                );
            }

            $this->secao_model->salvarSecaoPrateleira($dados_secao_prateleira);
            redirect(base_url("secao"));
        }
    }

    public function excluir_secao() {
        $id_secao = $this->uri->segment(3);

        if (empty($id_secao)) {
            redirect(base_url("secao"));
        } else {

            $this->secao_model->excluirSecaoPrateleira($id_secao);
            $this->secao_model->excluirSecao($id_secao);
            redirect(base_url("secao"));
        }
    }

    //put your code here
}

?>
