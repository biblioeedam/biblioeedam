<?php

class Tipos_Leitores_model extends CI_Model {
   
    function obterTodosTiposLeitores() {
        return $this->db->get('tipo_leitor');
    }
    
    //obtem um tipo de Leitor
    function obterTipoLeitor($id_tipo_leitor){
        return $this->db->get_where('tipo_leitor', array('id_tipo_leitor'=>$id_tipo_leitor));
    }
    
    
}

?>

