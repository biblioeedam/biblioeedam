<?php

class funcionario_model extends CI_Model {

    function obterFuncionario() {
        $this->db->select();
    }

    function obterFuncionarioLogin($dados) {
        return $this->db->get_where('funcionario', array('login_funcionario' => $dados['login_funcionario'], 'senha_funcionario' => $dados['senha_funcionario'],'status_funcionario' => $dados['status_funcionario']));
    }
    
    function obterTodosFuncionarios($qtde=0,$inicio=0){
        if($qtde >0) {$this->db->limit($qtde, $inicio);}
        return $this->db->get_where('funcionario', array('status_funcionario' => 1));
    }
    
    function contaFuncionarios(){
        return $this->db->count_all_results('funcionario');
    }
    
    function obterUmFuncionario($id_funcionario) {
        return $this->db->get_where('funcionario', array('id_funcionario' => $id_funcionario));
    }
    
    function obterUmFuncionario2($nome_funcionario){
        $this->db->like('nome_funcionario',$nome_funcionario);
        return $this->db->get_where('funcionario',array('status_funcionario' => 1));
    }
    
    function salvarFuncionario($dados=array()){
        $this->db->insert('funcionario', $dados);
        return $this->db->affected_rows();
    }
    
    function salvarFuncionarioAlterado($dados,$id_funcionario){
        $this->db->where('id_funcionario',$id_funcionario);
        $this->db->update('funcionario', $dados);
    }
    
    //Função exclui funcionario logicamente
    function excluirFuncionario($dados, $id_funcionario){
        $this->db->where('id_funcionario',$id_funcionario);
        $this->db->update('funcionario', $dados);
    }
    
    function obterLogin($funcionario_login){
        $this->db->where('funcionario_login', $funcionario_login);
        $this->db->get('funcionario', $funcionario_login);
        return $this->db-affected_rows();
    }
    
    function totalFuncionarios(){
        
    }

}

?>
