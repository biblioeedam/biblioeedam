<?php
class privilegios_model extends CI_Model {
    
    function obterTodosPrivilegios(){
            return $this->db->get('privilegio');
    }

}
