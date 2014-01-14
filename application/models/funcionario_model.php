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
        return $this->db->get_where('funcionario', array('usuario_funcionario' => $dados['usuario_funcionario'], 'senha_funcionario' => $dados['senha_funcionario']));
    }

//put your code here
}

?>
