<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_basico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('uri');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("item_model");
        $this->load->model("categoria_item_model");
        $this->load->model("tipo_item_model");
        $this->load->model("secao_model");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {
            
            $id_tipo_item = $this->input->post('tipoItem');
            $id_categoria_item = $this->input->post('categoriaItem');
            $nome_item = $this->input->post('nome_item');
            
            if(!empty($id_tipo_item) and !empty($id_categoria_item) and empty($nome_item)){ 
                $dados = array(
                    'todos_itens' => $this->item_model->obterItem1($id_tipo_item,$id_categoria_item)->result(),
                    'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                    'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result()
                );
            }elseif (!empty($id_tipo_item) and !empty($nome_item) and empty($id_categoria_item)) {
                $dados = array(
                    'todos_itens' => $this->item_model->obterItem2($id_tipo_item,$nome_item)->result(),
                    'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                    'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result()
                );       
            }elseif (!empty($id_tipo_item) and !empty($nome_item) and !empty($id_categoria_item)) {
                $dados = array(
                    'todos_itens' => $this->item_model->obterItem3($id_tipo_item,$id_categoria_item,$nome_item)->result(),
                    'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                    'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result()
                );                    
            }else{
                $dados = array(                    
                    'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                    'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result()
                );
            }
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('item_basico/localizacao_itens_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

}
