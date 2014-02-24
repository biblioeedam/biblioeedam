<?php

class Emprestimo_model extends CI_Model {
    
    function obterNomeLeitor($id_leitor){
        $this->db->select('nome_leitor');
        return $this->db->get_where('leitor',array('id_leitor'=>$id_leitor));
    }
    
}

?>
