<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Funcionario_model
 *
 * @author hairton
 */
class funcionario_model extends CI_Model {

    function obterFuncionario() {
        $this->db->select();
    }

    function obterFuncionarioLogin($dados) {
        return $this->db->get_where('funcionario', array('login_funcionario' => $dados['login_funcionario'], 'senha_funcionario' => $dados['senha_funcionario']));
    }
    
    function obterTodosFuncionarios(){
        return $this->db->get('funcionario');
    }
    
    function obterUmFuncionario($id_funcionario) {
        return $this->db->get_where('funcionario', array('id_funcionario' => $id_funcionario));
    }
    
    function salvarFuncionario($dados=array()){
        $this->db->insert('funcionario', $dados);
        return $this->db->affected_rows();
    }
    
    function salvarFuncionarioAlterado($dados,$id_funcionario){
        $this->db->where('id_funcionario',$id_funcionario);
        $this->db->update('funcionario', $dados);
    }
    
    function excluirFuncionario($id){
        $this->db->delete('funcionario', array('id_funcionario' => $id));
    }

//put your code here
}

?>
