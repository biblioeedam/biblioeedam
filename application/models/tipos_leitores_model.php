<?php

class Tipos_Leitores_model extends CI_Model {
   
    function obterTodosTiposLeitores() {
        return $this->db->get('tipo_leitor');
    }
    
    
}

?>

