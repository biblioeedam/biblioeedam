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
class pratileira_model extends CI_Model {

    function obterTodasPrateleiras() {
        return $this->db->get('patileira');
    }

    function obterUltimaPratileira() {
        $this->db->select_max('id_patileira', 'ultima_pratileira');
        return $query = $this->db->get('patileira');
    }

    function obterUmaPrateleira($id_prateleira) {
        return $this->db->get_where('patileira', array('id_patileira' => $id_prateleira));
    }

    function salvarPratileira($dados) {
        $this->db->insert('patileira', $dados);
    }
    
    function salvarPratileiraAlterada($dados,$id_pratelerira){
        $this->db->where('id_patileira',$id_pratelerira);
        $this->db->update('patileira', $dados);
    }
                function excluirPratileira($id) {
        $this->db->delete('patileira', array('id_patileira' => $id));
    }

    //put your code here
}

?>
