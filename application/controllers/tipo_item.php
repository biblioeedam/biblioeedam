<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipo_item extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("tipo_item_model");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $dados = array(
                'todos_tipos_itens' => $this->tipo_item_model->obterTodosTiposItens()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('tipo_item/tabela_tipo_item_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function novo_tipo_item() {


        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('tipo_item/forme_novo_tipo_item_view');

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salva_tipo_item() {

        $this->form_validation->set_rules('nomeTipoItem', 'Nome Tipo Item', "required");

        if ($this->form_validation->run() == false) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('tipo_item/forme_novo_tipo_item_view');
            $this->load->view('tela/rodape');
        } else {

            $nome_tipo_item = $_POST['nomeTipoItem'];

            $dados = array(
                'id_tipo_item' => '',
                'nome_tipo_item' => $nome_tipo_item
            );

            $this->tipo_item_model->salvarTipoItem($dados);

            redirect(base_url('tipo_item'));
        }
    }

    public function alterar_tipo_item() {

        $id_tipo_item = $this->uri->segment(3);

        if (empty($id_tipo_item)) {
            redirect(base_url('tipo_item'));
        } else {
            $id_tipo_item;
            $nome_tipo_item;

            $query = $this->tipo_item_model->obterUmTipoItem($id_tipo_item)->result();

            foreach ($query as $qr) {
                $id_tipo_item = $qr->id_tipo_item;
                $nome_tipo_item = $qr->nome_tipo_item;
            }

            $dados = array(
                'id_tipo_item' => $id_tipo_item,
                'nome_tipo_item' => $nome_tipo_item
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('tipo_item/forme_alterar_tipo_item_view', $dados);
            $this->load->view('tela/rodape');
        }
    }

    public function salva_tipo_item_alterada() {
        $this->form_validation->set_rules('nomeTipoItem', 'Nome Tipo Item', "required");

        $id_tipo_item = $_POST['idTipoItem'];

        if ($this->form_validation->run() == false) {
            redirect('tipo_item/alterar_tipo_item/' . $id_tipo_item);
        } else {

            $nome_tipo_item = $_POST['nomeTipoItem'];

            $dados = array(
                'nome_tipo_item' => $nome_tipo_item
            );

            $this->tipo_item_model->salvarTipoItemAlterada($dados, $id_tipo_item);

            redirect(base_url('tipo_item'));
        }
    }

    public function excluir_tipo_item() {

        $id_tipo_item = $this->uri->segment(3);

        if (empty($id_tipo_item)) {
            redirect(base_url('tipo_item'));
        } else {
            $verificador = 0;
            $query = $this->tipo_item_model->verificarTipoItemUtilisado($id_tipo_item)->result();
            foreach ($query as $qy) {
                $verificador = $qy->tipo_item;
            }

            if ($verificador > 0) {
                
            } else {

                $this->tipo_item_model->excluirTipoItem($id_tipo_item);
            }

            redirect(base_url('tipo_item'));
        }
    }

}
