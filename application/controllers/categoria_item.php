<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categoria_item extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("categoria_item_model");
        $this->load->library("pagination");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            //Configurações da paginação de dados
            $config['base_url'] = base_url("categoria_item/index");
            $config['total_rows'] = $this->categoria_item_model->obterTodasCategoriasItens()->num_rows(); 
            $config['per_page'] = 20;    
            $qtde = $config['per_page'];
            $inicio = (!$this->uri->segment(3)) ? 0 : $this->uri->segment(3);
            $this->pagination->initialize($config);
            
            $dados = array(
                'todas_categorias_itens' => $this->categoria_item_model->obterTodasCategoriasItens($qtde,$inicio)->result(),
                'paginacao' => $this->pagination->create_links(),
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('categoria_item/tabela_categoria_item_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function nova_categoria_item() {


        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('categoria_item/forme_nova_categoria_item_view');

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salva_categoria_item() {

        $this->form_validation->set_rules('nomeCategoriaItem', 'Nome Categoria Item', "required");

        if ($this->form_validation->run() == false) {

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('categoria_item/forme_nova_categoria_item_view');
            $this->load->view('tela/rodape');
        } else {

            $nome_categoria_item = $_POST['nomeCategoriaItem'];

            $dados = array(
                'id_categoria_item' => '',
                'nome_categoria_item' => $nome_categoria_item
            );

            $this->categoria_item_model->salvarCategoriaItem($dados);

            redirect(base_url('categoria_item'));
        }
    }

    public function alterar_categoria_item() {

        $id_categoria_item = $this->uri->segment(3);

        if (empty($id_categoria_item)) {
            redirect(base_url('categoria_item'));
        } else {
            $id_categoria_item;
            $nome_categoria_item;

            $query = $this->categoria_item_model->obterUmaCategoriaItem($id_categoria_item)->result();

            foreach ($query as $qr) {
                $id_categoria_item = $qr->id_categoria_item;
                $nome_categoria_item = $qr->nome_categoria_item;
            }

            $dados = array(
                'id_categoria_item' => $id_categoria_item,
                'nome_categoria_item' => $nome_categoria_item
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('categoria_item/forme_alterar_categoria_item_view', $dados);
            $this->load->view('tela/rodape');
        }
    }

    public function salva_categoria_item_alterada() {
        $this->form_validation->set_rules('nomeCategoriaItem', 'Nome Categoria Item', "required");

        $id_categoria_item = $_POST['idCategoriaItem'];

        if ($this->form_validation->run() == false) {
            redirect('categoria_item/alterar_categoria_item/' . $id_categoria_item);
        } else {

            $nome_categoria_item = $_POST['nomeCategoriaItem'];

            $dados = array(
                'nome_categoria_item' => $nome_categoria_item
            );

            $this->categoria_item_model->salvarCategoriaItemAlterada($dados, $id_categoria_item);

            redirect(base_url('categoria_item'));
        }
    }

    public function excluir_categoria_item() {

        $id_categoria_item = $this->uri->segment(3);

        if (!is_numeric($id_categoria_item)) {
            redirect(base_url('categoria_item'));
        } else {
            
            $qtde = $this->categoria_item_model->verificarCategoriaItemUtilisado($id_categoria_item);
         
            if ($qtde > 0) {
                redirect(base_url('categoria_item/'));
            } else {
                $this->categoria_item_model->excluirCategoriaItem($id_categoria_item);
            }
            
            
            redirect(base_url('categoria_item'));
        }
    }

}
