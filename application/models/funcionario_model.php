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
        $query = $this->db->get('funcionario');
        return $query->result();
    }
    
    function cadastrarFuncionario($dados=array()){
        $this->db->insert('funcionario', $dados);
        return $this->db->affected_rows();
    }

//put your code here
}

?>
