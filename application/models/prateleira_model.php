<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pratileira_model
 *
 * @author hairton
 */
class prateleira_model extends CI_Model {

    function obterTodasPrateleiras($qtde=0,$inicio=0) {
        if($qtde >0 ){$this->db->limit($qtde,$inicio);}
        return $this->db->get('prateleira');
    }

    function verificarPrateleiraUtilisada($id_prateleira) {
        $this->db->select_max('prateleira_id_prateleira', 'prateleira');
        $this->db->where('prateleira_id_prateleira', $id_prateleira);
        return $query = $this->db->get('secao_prateleira');
    }

    function obterUmaPrateleira($id_prateleira) {
        return $this->db->get_where('prateleira', array('id_prateleira' => $id_prateleira));
    }

    function salvarPrateleira($dados) {
        $this->db->insert('prateleira', $dados);
    }

    function salvarPrateleiraAlterada($dados, $id_prateleira) {
        $this->db->where('id_prateleira', $id_prateleira);
        $this->db->update('prateleira', $dados);
    }

    function excluirPrateleira($id) {
        $this->db->delete('prateleira', array('id_prateleira' => $id));
    }

    //put your code here
}

?>
