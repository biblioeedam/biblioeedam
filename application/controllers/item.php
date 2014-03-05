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
        $this->load->library("pagination");
        date_default_timezone_set('UTC');
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            //Configurações da paginação de dados
            $config['base_url'] = base_url("item/index");
            $config['total_rows'] = $this->item_model->obterTodosItens()->num_rows(); 
            $config['per_page'] = 20;    
            $qtde = $config['per_page'];
            $inicio = (!$this->uri->segment(3)) ? 0 : $this->uri->segment(3);
            $this->pagination->initialize($config);
            
            $dados = array(
                'todos_itens' => $this->item_model->obterTodosItens($qtde,$inicio)->result(),
                'paginacao' => $this->pagination->create_links(),
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
            $this->form_validation->set_rules('qtdItem', 'Quantidade', 'callback_qtdItem_check|trim|numeric|min_length[1]');            


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
                $qtd_item = $_POST['qtdItem'];


                

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
                    'status_item' => 1,
                    'id_funcionario' => $this->session->userdata('id_funcionario'),
                    'id_tipo_item' => $tipo_item,
                    'id_categoria_item' => $categoria_item,
                    'quantidade_item' => $qtd_item
                );

                $id=$this->item_model->salvarItem($dados);
                
                redirect(base_url('item/localizacao_item/'.$id));
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
            if (is_numeric($id_item)) {
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
                $this->session->set_flashdata('sucesso','Localização, salva com sucesso!');
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
        // capturando o seguimento 3 do url.
        $id_item = $this->uri->segment(3);
        // verificando se o seguimento 3 é vasiu
        if (is_numeric($id_item)) {
            // redirecionando para a tabela de item.
            redirect(base_url('item'));
        } else {

            //  Pegando dados para o formulario de alteração.
            $dados = array(
                //Item a ser alterado.
                'item' => $this->item_model->obterItenSelecionado($id_item)->result(),
                // Categoraias para disponibilizar no formulario de alteração 
                'categoria_item' => $this->categoria_item_model->obterTodasCategoriasItens()->result(),
                // Tipo para disponibilizar no formulario de alteração 
                'tipo_item' => $this->tipo_item_model->obterTodosTiposItens()->result(),
            );

            // Mostrando o formulário de alteração de item.
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu');
            $this->load->view('item/forme_alterar_item_view', $dados);
            $this->load->view('tela/rodape');
        }
    }

    public function salvar_item_alterado() {
        // verificando usuário logado.
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario'))) {

            // Id do item a ser alterado.
            $id_item = $_POST['idItem'];

            // regras de validação para os campos.
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
            $this->form_validation->set_rules('qtdItem', 'Quantidade', 'callback_qtdItem_check|trim|numeric|min_length[1]');   

            // verificando se as regras de todos os campos foram validas.
            if ($this->form_validation->run() == false) {
                // redirecionando para o formulario de alteração.
                redirect(base_url('item/alterar_item/' . $id_item));
            } else {
                // Capturando os dados do formulário para ser alterado.
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
                $qtd_item = $_POST['qtdItem'];


                $dados = array(
                    //'id_item' => '',
                    'nome_item' => $nome_item,
                    'numRegistro_item' => $numero_registro_item,
                    'autor_item' => $autor_item,
                    'origem_item' => $origem_item,
                   
                    'volume_item' => $volume_item,
                    'editora_item' => $editora_item,
                    'descricao_item' => $descricao_item,
                    'dataLancamento_item' => implode("-", array_reverse(explode("/", $data_lancamento_item))),
                    'id_funcionario' => $this->session->userdata('id_funcionario'),
                    'id_tipo_item' => $tipo_item,
                    'id_categoria_item' => $categoria_item,
                    'quantidade_item' => $qtd_item
                );


                $this->item_model->salvarItemAlterado($dados, $id_item);

                redirect(base_url('item'));
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    // função para fazer exclusão de item de maneira logica.
    public function excluir_item() {
        // Capturando o seguimento 3 da url que é o id do item a ser excluido
        $id_item = $this->uri->segment(3);
        // verificando se o seguimente 3 existe ou esta vasio
        if (!is_numeric($id_item)) {
            // redirecionando para a tabela inicial de item
            redirect(base_url('item'));
        } else {
            // atribuindo valores ao status para ser excluido
            $dados = array(
                'status_item' => 0,
            );
            // enviando os dados para o model excluir o item
            $this->item_model->excluirItem($dados,$id_item);
            $this->session->set_flashdata('sucesso','Item, excluido com sucesso!');
            // redirecionando para a tebela inicial de item.
            redirect(base_url('item'));
        }
    }
    
    //Valida a quantidade de itens disponíveis
    public function qtdItem_check($qtdItem) {
        if ($qtdItem < 1 || empty($qtdItem)) {
                $this->form_validation->set_message('qtdItem_check', 'A %s é inválida, verifique se você digitou um número válido!');
                return FALSE;
        } else {
                return TRUE;
        }
    }

}
