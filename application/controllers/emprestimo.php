<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emprestimo extends CI_Controller {

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
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario') == 1)) {


            $dados = array(
                'todos_emprestimos' => $this->emprestimo_model->obterTodosEmprestimos()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('emprestimo/tabela_emprestimo_view', $dados);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function obterItemEmprestimo() {

        $id_acao = $_POST['id_acao'];

        $query = $this->emprestimo_model->obterItemAcaoEntrestimo($id_acao)->result();

        foreach ($query as $qr) {
            echo $qr->nome_item . "<br/>";
        }
    }

    public function novo_emprestimo() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario') == 1)) {

            $opcao_novo_emprestimo = $this->uri->segment(3);

            switch ($opcao_novo_emprestimo) {
                case "leitor": {

                        $query;

                        if (isset($_POST['pesquisaLeitor']) && isset($_POST['opcaoPesquisaLeitor'])) {

                            $opcao_leitor = $_POST['opcaoPesquisaLeitor'];
                            $pesquisaLeitor = $_POST['pesquisaLeitor'];

                            if ($opcao_leitor == 'codigo') {
                                if (is_numeric($pesquisaLeitor)) {
                                    $query = $this->leitores_model->obterUmLeitor($pesquisaLeitor)->result();
                                } else {
                                    $query = $this->leitores_model->obtertodosleitores2()->result();
                                }
                            } else if ($opcao_leitor == 'nome') {
                                $query = $this->leitores_model->obterUmLeitor2($pesquisaLeitor)->result();
                            };
                        } else {
                            $query = $this->leitores_model->obtertodosleitores2()->result();
                        };

                        $dados = array(
                            'todos_leitores' => $query,
                        );

                        $this->load->view('tela/titulo');
                        $this->load->view('tela/menu_basico');
                        $this->load->view('emprestimo/forme_novo_emprestimo_leitor_view', $dados);
                        $this->load->view('tela/rodape');
                    }
                    break;

                case "selecionar_leitor": {
                        $id_leitor = $this->uri->segment(4);

                        if (is_numeric($id_leitor)) {

                            $query = $this->leitores_model->obterUmLeitor($id_leitor)->result();

                            foreach ($query as $qr) {
                                $this->session->set_userdata(array('id_leitor' => $qr->id_leitor, 'nome_leitor' => $qr->nome_leitor));
                            }

                            redirect(base_url('emprestimo/novo_emprestimo/item'));
                        };
                    }
                    break;

                case "item": {

                        $datestring = date('d/m/Y');
                        $time = time();
                        $item = $this->item_model->obterTodosItens()->result();
                        $todos_itens = array();

                        foreach ($item as $ti) {
                            $qtde = $this->emprestimo_model->obterQuantidadeItemDisponivel($ti->id_item);

                            $ti->disponivel_item = $ti->quantidade_item - $qtde;
                            $todos_itens[] = $ti;
                        }



                        $dados = array(
                            'dtAtual' => mdate($datestring, $time),
                            'tipos_item' => $this->emprestimo_model->obterTiposItem()->result(),
                            'todos_itens' => $todos_itens
                        );

                        $this->load->view('tela/titulo');
                        $this->load->view('tela/menu_basico');
                        $this->load->view('emprestimo/forme_novo_emprestimo_item_view', $dados);
                        $this->load->view('tela/rodape');
                    }
                    break;

                case "incluir_item": {
                        $id_item = $this->uri->segment(4);
                        if (is_numeric($id_item)) {
                            $query = $this->item_model->obterItenSelecionado($id_item)->result();
                            $item = get_object_vars($query[0]);

                            $qtde = $this->emprestimo_model->obterQuantidadeItemDisponivel($item['id_item']);

                            if ($item['quantidade_item']-$qtde > 1) {
                                $verificar = false;

                                if (!empty($this->session->userdata("item_emprestimo"))) {
                                    $item_para_emprestimo = $this->session->userdata("item_emprestimo");
                                    foreach ($item_para_emprestimo as $ipe) {
                                        if ($ipe['id_item'] == $item['id_item']) {
                                            $verificar = true;
                                            break;
                                        }
                                    }
                                }

                                if ($verificar == FALSE) {
                                    foreach ($query as $qy) {
                                        $item_para_emprestimo[] = array(
                                            'id_item' => $qy->id_item,
                                            'nome_item' => $qy->nome_item
                                        );
                                    }

                                    $dados = array(
                                        'item_emprestimo' => $item_para_emprestimo,
                                    );

                                    $this->session->set_userdata($dados);
                                }
                            }
                            redirect(base_url("emprestimo/novo_emprestimo/item"));
                        } else {
                            redirect(base_url("emprestimo/novo_emprestimo/item"));
                        }
                    }
                    break;

                case "cacelar_itens_emprestimo": {
                        $this->session->unset_userdata("item_emprestimo");
                        redirect(base_url("emprestimo/novo_emprestimo/item"));
                    }
                    break;
                case "salvar_emprestimo": {

                        $this->form_validation->set_rules('dt_devolucao', 'Data de Devolução', 'required');


                        if ($this->form_validation->run() == FALSE) {
                            $datestring = date('d/m/Y');
                            $time = time();

                            $dados = array(
                                'dtAtual' => mdate($datestring, $time),
                                'tipos_item' => $this->emprestimo_model->obterTiposItem()->result(),
                                'todos_itens' => $this->item_model->obterTodosItens()->result(),
                            );

                            $this->load->view('tela/titulo');
                            $this->load->view('tela/menu_basico');
                            $this->load->view('emprestimo/forme_novo_emprestimo_item_view', $dados);
                            $this->load->view('tela/rodape');
                        } else {
                            $dados = array(
                                'data_acao' => date('Y-m-d'),
                                'dataDevolucao_acao' => $this->input->post('dt_devolucao'),
                                'id_leitor' => $this->session->userdata('id_leitor'),
                                'id_funcionario' => $this->session->userdata('id_funcionario'),
                                'id_tipo_acao' => 1,
                            );

                            $query = $this->emprestimo_model->registraEmprestimo($dados)->result();

                            $id_acao;

                            foreach ($query as $qy) {
                                $id_acao = $qy->id_acao;
                            }

                            $dados_item = array();

                            $item_emprestimo = $this->session->userdata('item_emprestimo');

                            foreach ($item_emprestimo as $ie) {

                                $teste = array(
                                    'id_acao' => $id_acao,
                                    'id_item' => $ie['id_item'],
                                    'status' => 1,
                                );
                                array_push($dados_item, $teste);
                            }
                            
                            $this->emprestimo_model->salvar_itens_emprestimo($dados_item);

                            redirect(base_url("emprestimo/novo_emprestimo/cancelar_emprestimo"));
                        }
                    }
                    break;
                case "cancelar_emprestimo": {
                        $this->session->unset_userdata(array('id_leitor' => "", 'nome_leitor' => "", 'item_emprestimo' => ""));

                        redirect(base_url("emprestimo"));
                    }
                    break;
            }
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function obter_nome_leitor() {


        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario') == 1)) {

            // $id_leitor = $_POST['id_leitor'];
            // $resultado = $this->emprestimo_model->obterNomeLeitor($id_leitor)->result();

            echo 'Hairton';
        } else {
            //  redirect(base_url() . "seguranca");
            echo 'ola';
        }
    }

}

