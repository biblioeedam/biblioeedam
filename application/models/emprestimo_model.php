<?php

class Emprestimo_model extends CI_Model {

    function obterNomeLeitor($id_leitor) {
        $this->db->select('nome_leitor');
        return $this->db->get_where('leitor', array('id_leitor' => $id_leitor));
    }

    function obterTodosEmprestimos() {
        $this->db->where('id_tipo_acao !=', 0);
        return $this->db->get('acao');
    }

    function obterTiposItem() {
        return $this->db->get('tipo_item');
    }

    function registraEmprestimo($dados = array()) {        
        $this->db->insert('acao', $dados);
        $this->db->select_max('id_acao');
        return $this->db->get('acao');
        
    }

    function salvar_itens_emprestimo($dados){
        $this->db->insert_batch('item_acao', $dados); 
    }


}

?>
