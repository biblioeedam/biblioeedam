<?php

class Emprestimo_model extends CI_Model {

    function obterNomeLeitor($id_leitor) {
        $this->db->select('nome_leitor');
        return $this->db->get_where('leitor', array('id_leitor' => $id_leitor));
    }

    function obterTodosEmprestimos() {
        $this->db->select("*");
        $this->db->from("acao A");
        $this->db->join("leitor L", "L.id_leitor=A.id_leitor");
        $this->db->where('id_tipo_acao ', 1);
        return $this->db->get();
    }

    function obterQuantidadeItemDisponivel($id_item) {
        $this->db->where(array('id_item'=> $id_item,'status'=>1));
        $this->db->from('item_acao');
        return $this->db->count_all_results();
        
    }

    function obterItemAcaoEntrestimo($id_acao) {
        $this->db->select("I.nome_item");
        $this->db->from("acao A");
        $this->db->join("item_acao IA", "A.id_acao=IA.id_acao");
        $this->db->join("item I", "I.id_item=IA.id_item");
        $this->db->where("A.id_acao", $id_acao);
        return $this->db->get();
    }

    function obterTiposItem() {
        return $this->db->get('tipo_item');
    }

    function registraEmprestimo($dados = array()) {
        $this->db->insert('acao', $dados);
        $this->db->select_max('id_acao');
        return $this->db->get('acao');
    }

    function salvar_itens_emprestimo($dados) {
        $this->db->insert_batch('item_acao', $dados);
    }

}

?>
