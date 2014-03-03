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
class secao_model extends CI_Model {

    function obterTodasSecoes($qtde=0,$inicio=0) {
        if($qtde >0 ){$this->db->limit($qtde,$inicio);}
        $this->db->order_by('id_secao','desc');
        return $this->db->get('secao');
    }

    function obterUltimaPrateleira() {
        $this->db->select_max('id_prateleira', 'ultima_prateleira');
        return $query = $this->db->get('prateleira');
    }

    function obterUmaSecao($id_secao) {
        return $this->db->get_where('secao', array('id_secao' => $id_secao));
    }

    function salvarNovaSecao($dados) {
        $this->db->insert('secao', $dados);
        $this->db->select_max('id_secao', 'secao_inserida');
        return $query = $this->db->get('secao');
    }

    function salvarSecaoPrateleira($dados) {
        $this->db->insert_batch('secao_prateleira', $dados);
    }

    function obterPrateleirasPorSecao($id_secao) {
        $this->db->select('nome_prateleira');
        $this->db->from('secao S');
        $this->db->join('secao_prateleira SP', 'SP.id_secao=S.id_secao');
        $this->db->join('prateleira P', 'SP.id_prateleira=P.id_prateleira');
        $this->db->where('S.id_secao', $id_secao);
        return $this->db->get();
        /*
         * SELECT
          nome_prateleira
          FROM
          secao S
          INNER JOIN secao_prateleira SP on(S.id_secao=SP.secao_id_secao)
          INNER JOIN prateleira P on(P.id_prateleira=SP.prateleira_id_prateleira)
          where
          S.id_secao = 5
         * 
         */
    }

    function salvarSecaoAlterada($dados, $id_secao) {
        $this->db->where('id_secao', $id_secao);
        $this->db->update('secao', $dados);
    }

    function excluirSecao($id_secao) {
        $this->db->delete('secao', array('id_secao' => $id_secao));
    }

    function excluirSecaoPrateleira($id_secao) {
        $this->db->delete('secao_prateleira', array('id_secao' => $id_secao));
    }

    //put your code here
}

?>
