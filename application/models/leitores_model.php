<?php

class Leitores_model extends CI_Model {
/*
    function obterFuncionarioLogin($dados) {
        return $this->db->get_where('funcionario', array('login_funcionario' => $dados['login_funcionario'], 'senha_funcionario' => $dados['senha_funcionario']));
    }
   */  
    function obterTodosLeitores(){
        return $this->db->get_where('leitor');
    }
   
    function obterUmLeitor($id_leitor) {
        return $this->db->get_where('leitor', array('id_leitor' => $id_leitor));
    }
    
    function salvarLeitor($dados=array()){
        $this->db->insert('leitor', $dados);
        return $this->db->affected_rows();
    }
 
    function salvarLeitorAlterado($dados,$id_leitor){
        $this->db->where('id_leitor',$id_leitor);
        $this->db->update('leitor', $dados);
    }
   
    function excluirLeitor($id_leitor){
        $this->db->delete('leitor', array('id_leitor' => $id_leitor));
    }

}
?>