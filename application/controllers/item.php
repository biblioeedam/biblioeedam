<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item extends CI_Controller {

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

            $dados = array(
                'todos_itens' => $this->item_model->obterTodosItens()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('item/tabela_item_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function novo_item() {


        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            $dados = array(
                'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result(),
            );



            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('item/forme_novo_item_view', $dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salvar_item() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {


            $this->form_validation->set_rules('nomeItem', 'Nome Item', "required");
            $this->form_validation->set_rules('numeroRegistroItem', 'Numero Registro', "required");
            $this->form_validation->set_rules('autorItem', 'Autor', "required");
            $this->form_validation->set_rules('origemItem', 'Origem', "required");
            $this->form_validation->set_rules('volumeItem', 'Volume', "required|numeric");
            $this->form_validation->set_rules('editoraItem', 'Editora', "required");
            $this->form_validation->set_rules('descricaoItem', 'Descrição', "");
            $this->form_validation->set_rules('dataLancamentoItem', 'Data Lançamento', "required");
            $this->form_validation->set_rules('categoriaItem', 'Categoria', "required");
            $this->form_validation->set_rules('tipoItem', 'Tipo', "required");


            if ($this->form_validation->run() == false) {

                $dados = array(
                    'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                    'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result(),
                );

                $this->load->view('tela/titulo');
                $this->load->view('tela/menu');
                $this->load->view('item/forme_novo_item_view', $dados);
                $this->load->view('tela/rodape');
            } else {

                $nome_item = $_POST['nomeItem'];
                $numero_registro_item = $_POST['numeroRegistroItem'];
                $autor_item = $_POST['autorItem'];
                $origem_item = $_POST['origemItem'];
                $volume_item = $_POST['volumeItem'];
                $editora_item = $_POST['editoraItem'];
                $descricao_item = $_POST['descricaoItem'];
                $data_lancamento_item = $_POST['dataLancamentoItem'];
                $categoria_item = $_POST['categoriaItem'];
                $tipo_item = $_POST['tipoItem'];


                date_default_timezone_set('UTC');

                $dados = array(
                    'id_item' => '',
                    'nome_item' => $nome_item,
                    'numRegistro_item' => $numero_registro_item,
                    'autor_item' => $autor_item,
                    'origem_item' => $origem_item,
                    'dataCadastro_item' => date("Y-m-d", time()),
                    'volume_item' => $volume_item,
                    'editora_item' => $editora_item,
                    'descricao_item' => $descricao_item,
                    'dataLancamento_item' => implode("-", array_reverse(explode("/", $data_lancamento_item))),
                    'id_funcionario' => $this->session->userdata('id_funcionario'),
                    'id_tipo_item' => $tipo_item,
                    'id_categoria_item' => $categoria_item
                );




                $this->item_model->salvarItem($dados);

                redirect(base_url('item'));
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function localizacao_item() {
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            // Capturando o seguimento três da URL atual
            $id_item = $this->uri->segment(3);

            // verificando se o seguimento existe
            if (empty($id_item)) {
                redirect(base_url("item"));
            } else {

                // verificando se a localização para o item já existe.
                $verificar = FALSE;
                // iniciando variavel de secao salva
                $secaoSalva;
                // iniciando variavel de ordem salva
                $ordemSalva;

                $query = $this->item_model->obterItemSecaoOrdemItem($id_item)->result();
                foreach ($query as $qr) {
                    $verificar = TRUE;
                    $ordemSalva = $qr->id_ordem_item;
                    $secaoSalva = $qr->id_secao;
                }

                // Se a verificação for igual a falso mostre o formulario de adicionar 
                // se True mostre o forme para alterar
                if ($verificar == FALSE) {

                    // dados para formulario de adição e informações sobre o item
                    $dados = array(
                        'id_item' => $id_item,
                        'todos_itens' => $this->item_model->obterItenSelecionado($id_item)->result(),
                        'ordem_item' => $this->item_model->obterTodasOrdens()->result(),
                        'secao_item' => $this->item_model->obterTodasSecoes()->result(),
                    );

                    // mostrando a tela de formulario de adicionar localização
                    $this->load->view('tela/titulo');
                    $this->load->view('tela/menu');
                    $this->load->view('item/forme_localizacao_item_view', $dados);
                    $this->load->view('tela/rodape');
                } else {



                    $prateleiras = '';
                    $query = $this->secao_model->obterPrateleirasPorSecao($secaoSalva)->result();
                    foreach ($query as $qy) {
                        $prateleiras = $prateleiras . '<button class="btn btn-default">' . $qy->nome_prateleira . '</button>';
                    }




                    // dados para formulario de alteracao e informações sobre o item
                    $dados = array(
                        'id_item' => $id_item,
                        'id_ordem' => $ordemSalva,
                        'id_secao' => $secaoSalva,
                        'prateleiras_secao' => $prateleiras,
                        'todos_itens' => $this->item_model->obterItenSelecionado($id_item)->result(),
                        'ordem_item' => $this->item_model->obterTodasOrdens()->result(),
                        'secao_item' => $this->item_model->obterTodasSecoes()->result(),
                    );

                    // mostrando a tela de formulario de alteração localização
                    $this->load->view('tela/titulo');
                    $this->load->view('tela/menu');
                    $this->load->view('item/forme_localizacao_alterar_item_view', $dados);
                    $this->load->view('tela/rodape');
                }
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function salvar_localizacao() {
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {
            $this->form_validation->set_rules("ordemItem", "Ordem Item", "required");
            $this->form_validation->set_rules("secaoItem", "Secao", "required");

            $id_item = $_POST['idItem'];

            if ($this->form_validation->run() == false) {

                $dados = array(
                    'id_item' => $id_item,
                    'todos_itens' => $this->item_model->obterItenSelecionado($id_item)->result(),
                    'ordem_item' => $this->item_model->obterTodasOrdens()->result(),
                    'secao_item' => $this->item_model->obterTodasSecoes()->result(),
                );

                $this->load->view('tela/titulo');
                $this->load->view('tela/menu');
                $this->load->view('item/forme_localizacao_item_view', $dados);
                $this->load->view('tela/rodape');
            } else {

                $id_secao = $_POST['secaoItem'];
                $id_ordem = $_POST['ordemItem'];

                $dados = array(
                    'id_item' => $id_item,
                    'id_secao' => $id_secao,
                    'id_ordem_item' => $id_ordem
                );

                // Enviando os dados para o model salvar a localização do item
                $this->item_model->salvarItemSecaoOrdemItem($dados);

                // Redirecionando para a tebela de item
                redirect(base_url("item"));
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    // Função para alterar localização do item
    public function alterar_localizacao() {
        // Verificando se o usuario esta logado.
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {
            // Adicionando regra de validação.
            $this->form_validation->set_rules("ordemItem", "Ordem Item", "required");
            $this->form_validation->set_rules("secaoItem", "Secao", "required");

            // Capturando o id do item que vai ser alterado.
            $id_item = $_POST['idItem'];

            // Verificando se os campos são validos.
            if ($this->form_validation->run() == false) {
                // Redirecionando para o formulario de alteracao novamente.
                redirect(base_url("item/localizacao_item/" . $id_item));
            } else {

                // capturando os dados do formulario que foi validado.
                $id_secao = $_POST['secaoItem'];
                $id_ordem = $_POST['ordemItem'];

                // criando um array de dados para alterar o banco de dados
                $dados = array(
                    'id_item' => $id_item,
                    'id_secao' => $id_secao,
                    'id_ordem_item' => $id_ordem
                );

                // eviando os dado para o model alterar os dados no banco de dados
                $this->item_model->AlterarItemSecaoOrdemItem($dados, $id_item);

                redirect(base_url("item"));
            }
        } else {
            // Redirecionando o usuário para a tela de login
            redirect(base_url() . "seguranca");
        }
    }

    public function alterar_item() {

        $id_item = $this->uri->segment(3);

        if (empty($id_item)) {
            redirect(base_url('item'));
        } else {


            $dados = array(
                'item' => $this->item_model->obterItenSelecionado($id_item)->result(),
                'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result(),
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('item/forme_alterar_item_view', $dados);
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

        if (empty($id_categoria_item)) {
            redirect(base_url('categoria_item'));
        } else {
            $verificador = 0;
            $query = $this->categoria_item_model->verificarCategoriaItemUtilisado($id_categoria_item)->result();
            foreach ($query as $qy) {
                $verificador = $qy->categoria_item;
            }

            if ($verificador > 0) {
                
            } else {
                $this->categoria_item_model->excluirCategoriaItem($id_categoria_item);
            }
            redirect(base_url('categoria_item'));
        }
    }

}
