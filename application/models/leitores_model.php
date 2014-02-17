<?php

class Leitores_model extends CI_Model {
 
    function obterTodosLeitores(){
        return $this->db->get('leitor');
    }
   
    function obterUmLeitor($id_leitor) {
        return $this->db->get_where('leitor', array('id_leitor' => $id_leitor));
    }
    
    function salvarLeitor($dados=array()){
        $this->db->insert('leitor', $dados);
        return $this->db->affected_rows();
    }
 
    function salvarLeitorAlterado($dados,$id_leitor){
        $this->db->where('id_leitor',$id_leitor);
        $this->db->update('leitor', $dados);
    }
   
    function obterDadosCartaoLeitor($id_leitor){
        $this->db->select('nome_tipo_leitor,nome_leitor,serie_leitor,turma_leitor,turno_leitor,telefone_leitor');
        $this->db->from('leitor');
        $this->db->join('tipo_leitor','leitor.id_tipo_leitor = tipo_leitor.id_tipo_leitor');
        $this->db->where('id_leitor', $id_leitor);
        return $this->db->get();
        
    }
    
    //Criar aqui um metodo para incluir tipos de ação

}
?>