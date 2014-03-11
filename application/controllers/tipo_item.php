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
        $this->load->library("pagination");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            //Configurações da paginação de dados
            $config['base_url'] = base_url("tipo_item/index");
            $config['total_rows'] = $this->tipo_item_model->obterTodosTiposItens()->num_rows();
            $config['per_page'] = 20;
            $qtde = $config['per_page'];
            $inicio = (!$this->uri->segment(3)) ? 0 : $this->uri->segment(3);
            $this->pagination->initialize($config);

            $dados = array(
                'todos_tipos_itens' => $this->tipo_item_model->obterTodosTiposItens($qtde, $inicio)->result(),
                'paginacao' => $this->pagination->create_links(),
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
            $this->session->set_flashdata('sucesso','Tipo de Item, salvo com sucesso!');

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
            $this->session->set_flashdata('sucesso','Tipo de Item, alterado com sucesso!');

            redirect(base_url('tipo_item'));
        }
    }

    public function excluir_tipo_item() {

        $id_tipo_item = $this->uri->segment(3);

        if (!is_numeric($id_tipo_item)) {
            redirect(base_url('tipo_item'));
        } else {
            $qtde = $this->tipo_item_model->verificarTipoItemUtilisado($id_tipo_item);

            if ($qtde > 0) {
                redirect(base_url("tipo_item"));
            } else {

                $this->tipo_item_model->excluirTipoItem($id_tipo_item);
                $this->session->set_flashdata('sucesso','Tipo de Item, excluído com sucesso!');

            }

            redirect(base_url('tipo_item'));
        }
    }

}
