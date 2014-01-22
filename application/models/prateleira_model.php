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

    function obterTodasPrateleiras() {
        return $this->db->get('prateleira');
    }

    function obterUltimaPrateleira() {
        $this->db->select_max('id_prateleira', 'ultima_prateleira');
        return $query = $this->db->get('prateleira');
    }

    function obterUmaPrateleira($id_prateleira) {
        return $this->db->get_where('prateleira', array('id_prateleira' => $id_prateleira));
    }

    function salvarPrateleira($dados) {
        $this->db->insert('prateleira', $dados);
    }
    
    function salvarPrateleiraAlterada($dados,$id_pratelerira){
        $this->db->where('id_prateleira',$id_pratelerira);
        $this->db->update('prateleira', $dados);
    }
                function excluirPrateleira($id) {
        $this->db->delete('prateleira', array('id_prateleira' => $id));
    }

    //put your code here
}

?>
