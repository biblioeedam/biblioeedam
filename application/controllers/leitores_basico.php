<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leitores_basico extends CI_Controller {

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
        $this->load->library("pagination");
    }

    public function index() {

        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {

            //Configurações da paginação de dados
            $config['base_url'] = base_url("leitores_basico/index");
            $config['total_rows'] = $this->leitores_model->obterTodosLeitores()->num_rows(); 
            $config['per_page'] = 1;    
            $qtde = $config['per_page'];
            $inicio = (!$this->uri->segment(3)) ? 0 : $this->uri->segment(3);
            $this->pagination->initialize($config);
            
            
            //verifica se exite valor no campo de busca na tabela de leitores para usuarios de permissão básica 
            $nome_leitor = $this->input->post('nome_busca_leitor');
            if(!empty($nome_leitor)){
                $dados = array(
                    'todos_leitores' => $this->leitores_model->obterUmLeitor2($nome_leitor)->result()
                );
            }else{    
                $dados = array(
                    'todos_leitores' => $this->leitores_model->obterTodosLeitores($qtde,$inicio)->result(),
                    'paginacao' => $this->pagination->create_links(),
                );
            }
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('leitores_basico/tabela_leitores_view',$dados);

            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }

    public function novo_leitor() {
 
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {
            
            $tipos_leitores = array(
                'todos_tipos_leitores' => $this->tipos_leitores_model->obterTodosTiposLeitores()->result()
            );

            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('leitores_basico/forme_novo_leitor_view',$tipos_leitores);
            $this->load->view('tela/rodape');
        } else {
            redirect(base_url() . "seguranca");
        }
    }
    
    function salvar_leitor(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {

            $this->form_validation->set_rules('tipo_leitor','Tipo de Leitor','required');
            $this->form_validation->set_rules('nome_leitor','Nome','required');
            $this->form_validation->set_rules('cpf_leitor', 'CPF', 'callback_cpf_check|trim|numeric|min_length[11]|max_length[11]|is_unique[leitor.cpf_leitor]');

            $this->form_validation->set_rules('email_leitor', 'E-mail', 'valid_email');
            $this->form_validation->set_rules('repita_email_leitor', 'Repita o e-mail', 'valid_email|matches[email_leitor]'); 
            $this->form_validation->set_rules('serie_leitor');
            $this->form_validation->set_rules('turno_leitor');
            $this->form_validation->set_rules('turma_leitor');
            $this->form_validation->set_rules('nomePai_leitor');
            $this->form_validation->set_rules('nomeMae_leitor');
            $this->form_validation->set_rules('telefone_leitor','Telefone para Contato','required');
            $this->form_validation->set_rules('rua_residencia_leitor');
            $this->form_validation->set_rules('numero_residencia_leitor');
            $this->form_validation->set_rules('bairro_residencia_leitor');
            $this->form_validation->set_rules('cidade_leitor','Cidade','required');
            $this->form_validation->set_rules('distrito_leitor');
            $this->form_validation->set_rules('referencia_residencia_leitor');    

            if ($this->form_validation->run() == FALSE){
                $tipos_leitores = array(
                    'todos_tipos_leitores' => $this->tipos_leitores_model->obterTodosTiposLeitores()->result()
                );
                $this->load->view('tela/titulo');
                $this->load->view('tela/menu_basico');
                $this->load->view('leitores_basico/forme_novo_leitor_view',$tipos_leitores);
                $this->load->view('tela/rodape');
            }
            else{
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
                    'dataCadastro_leitor' => date("Y-m-d", time()),
                    'status_leitor' => 1,
                    'rua_residencia_leitor' => $this->input->post('rua_residencia_leitor'),
                    'numero_residencia_leitor' => $this->input->post('numero_residencia_leitor'),
                    'bairro_residencia_leitor' => $this->input->post('bairro_residencia_leitor'),
                    'cidade_leitor' => $this->input->post('cidade_leitor'),
                    'distrito_leitor' => $this->input->post('distrito_leitor'),
                    'referencia_residencia_leitor' => $this->input->post('referencia_residencia_leitor'),
                );
                if($this->leitores_model->salvarLeitor($dados)){
                    redirect('leitores_basico');
                } 
            }
        }else{
            redirect(base_url() . "seguranca");
        }
               
    }
    
    function alterar_leitor(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {

            $id_leitor = $this->uri->segment(3);

            if (empty($id_leitor)) {
                redirect(base_url('leitores_basico'));
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
                    $rua_residencia_leitor = $qr->rua_residencia_leitor; 
                    $numero_residencia_leitor = $qr->numero_residencia_leitor; 
                    $bairro_residencia_leitor = $qr->bairro_residencia_leitor;
                    $cidade_leitor = $qr->cidade_leitor;
                    $distrito_leitor = $qr->distrito_leitor;
                    $referencia_residencia_leitor = $qr->referencia_residencia_leitor;
                    $id_tipo_leitor = $qr->id_tipo_leitor;
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
                    'tipos_leitores' => $tipos_leitores,
                    'id_tipo_leitor' => $id_tipo_leitor
                );

                $this->load->view('tela/titulo');
                $this->load->view('tela/menu_basico');
                $this->load->view('leitores_basico/forme_alterar_leitor_view', $dados);
                $this->load->view('tela/rodape');
            }
        }else{
            redirect(base_url() . "seguranca");    
        }
    }
    
    //Salva os dados do leitor a ser alterado
    function salvar_leitor_alterado(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {

            $this->form_validation->set_rules('id_leitor');
            $this->form_validation->set_rules('tipo_leitor','Tipo de Leitor','required');
            $this->form_validation->set_rules('nome_leitor','Nome','required');
            $this->form_validation->set_rules('cpf_leitor');
            $this->form_validation->set_rules('email_leitor', 'E-mail', 'valid_email');
            $this->form_validation->set_rules('repita_email_leitor', 'Repita o e-mail', 'valid_email|matches[email_leitor]'); 
            $this->form_validation->set_rules('serie_leitor');
            $this->form_validation->set_rules('turno_leitor');
            $this->form_validation->set_rules('turma_leitor');
            $this->form_validation->set_rules('nomePai_leitor');
            $this->form_validation->set_rules('nomeMae_leitor');
            $this->form_validation->set_rules('telefone_leitor','Telefone para Contato','required');
            $this->form_validation->set_rules('rua_residencia_leitor');
            $this->form_validation->set_rules('numero_residencia_leitor');
            $this->form_validation->set_rules('bairro_residencia_leitor');
            $this->form_validation->set_rules('cidade_leitor','Cidade','required');
            $this->form_validation->set_rules('distrito_leitor');
            $this->form_validation->set_rules('referencia_residencia_leitor');    

            if ($this->form_validation->run() == FALSE){
                $id_leitor = $this->input->post('id_leitor');
                
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
                    $rua_residencia_leitor = $qr->rua_residencia_leitor; 
                    $numero_residencia_leitor = $qr->numero_residencia_leitor; 
                    $bairro_residencia_leitor = $qr->bairro_residencia_leitor;
                    $cidade_leitor = $qr->cidade_leitor;
                    $distrito_leitor = $qr->distrito_leitor;
                    $referencia_residencia_leitor = $qr->referencia_residencia_leitor;
                    $id_tipo_leitor = $qr->id_tipo_leitor;
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
                    'tipos_leitores' => $tipos_leitores,
                    'id_tipo_leitor' => $id_tipo_leitor
                );

                $this->load->view('tela/titulo');
                $this->load->view('tela/menu_basico');
                $this->load->view('leitores_basico/forme_alterar_leitor_view', $dados);
                $this->load->view('tela/rodape');

            }else{
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
                $tipo_leitor = $this->input->post('tipo_leitor');

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
                    'id_tipo_leitor' => $tipo_leitor
                );

                $this->leitores_model->salvarLeitorAlterado($dados, $id_leitor);

                redirect(base_url('leitores_basico'));
            }
        }else{
            redirect(base_url() . "seguranca");
        }
    }
    
    //Emite cartão da biblioteca de determinado Leitor
    function emitir_cartao_leitor(){
        if (($this->session->userdata('id_funcionario')) && ($this->session->userdata('nome_funcionario')) && ($this->session->userdata('login_funcionario')) && ($this->session->userdata('senha_funcionario')) && ($this->session->userdata('status_funcionario')==1)) {

            $id_leitor = $this->uri->segment(3);
            
            $query = $this->leitores_model->obterDadosCartaoLeitor($id_leitor)->result();
          
            foreach ($query as $rs){
                $nome_tipo_leitor = $rs->nome_tipo_leitor;
                $nome_leitor = $rs->nome_leitor;
                $serie_leitor = $rs->serie_leitor;
                $turma_leitor = $rs->turma_leitor;
                $turno_leitor = $rs->turno_leitor;
                $telefone_leitor = $rs->telefone_leitor;
            }
            
            $dados=array(
              'id_leitor' => $id_leitor,
              'nome_tipo_leitor' => $nome_tipo_leitor,  
              'nome_leitor' => $nome_leitor,
              'serie_leitor' => $serie_leitor,
              'turma_leitor' => $turma_leitor,
              'turno_leitor' => $turno_leitor,
              'telefone_leitor' => $telefone_leitor,
              'dataAtual' => date('d/m/Y')   
            );
            
            $this->load->view('tela/titulo');
            $this->load->view('tela/menu_basico');
            $this->load->view('leitores_basico/cartao_leitor_view',$dados);
            $this->load->view('tela/rodape');
        }else{
            redirect(base_url() . "seguranca");
        }
           
    }
    
    public function cpf_check($cpf) {
        if(!empty($cpf)){
            //Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
            $j = 0;
            for ($i = 0; $i < (strlen($cpf)); $i++) {
                if (is_numeric($cpf[$i])) {
                    $num[$j] = $cpf[$i];
                    $j++;
                }
            }
            //Etapa 2: Conta os dígitos, um cpf válido possui 11 dígitos numéricos.
            if (count($num) != 11) {
                $isCpfValid = false;
            }
            //Etapa 3: Combinações como 00000000000 e 22222222222 embora não sejam cpfs reais resultariam em cpfs válidos após o calculo dos dígitos ve rificares e por isso precisam ser filtradas nesta parte.
            else {
                for ($i = 0; $i < 10; $i++) {
                    if ($num[0] == $i && $num[1] == $i && $num[2] == $i && $num[3] == $i && $num[4] == $i && $num[5] == $i && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                        $isCpfValid = false;
                        break;
                    }
                }
            }
            //Etapa 4: Calcula e compara o primeiro dígito verificador.
            if (!isset($isCpfValid)) {
                $j = 10;
                for ($i = 0; $i < 9; $i++) {
                    $multiplica[$i] = $num[$i] * $j;
                    $j--;
                }
                $soma = array_sum($multiplica);
                $resto = $soma % 11;
                if ($resto < 2) {
                    $dg = 0;
                } else {
                    $dg = 11 - $resto;
                }
                if ($dg != $num[9]) {
                    $isCpfValid = false;
                }
            }
            //Etapa 5: Calcula e compara o segundo dígito verificador.
            if (!isset($isCpfValid)) {
                $j = 11;
                for ($i = 0; $i < 10; $i++) {
                    $multiplica[$i] = $num[$i] * $j;
                    $j--;
                }
                $soma = array_sum($multiplica);
                $resto = $soma % 11;
                if ($resto < 2) {
                    $dg = 0;
                } else {
                    $dg = 11 - $resto;
                }
                if ($dg != $num[10]) {
                    $isCpfValid = false;
                } else {
                    $isCpfValid = true;
                }
            }

            //$isCpfValid;


            if ($isCpfValid == FALSE) {
                $this->form_validation->set_message('cpf_check', 'O %s é invalido, Verirfique se digitou corretamente!');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    
    
}

