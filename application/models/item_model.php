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
class item_model extends CI_Model {

    function obterTodosItens() {
        return $this->db->get('item');
    }

    function verificarCategoriaItemUtilisado($id_categoria_item) {
        $this->db->select_max('id_categoria_item', 'cartegoria_item');
        $this->db->where('id_categoria_item', $id_categoria_item);
        return $query = $this->db->get('item');
    }

    function obterUmaCategoriaItem($id_categoria_item) {
        return $this->db->get_where('categoria_item', array('id_categoria_item' => $id_categoria_item));
    }

    function salvarItem($dados) {
        $this->db->insert('item', $dados);
    }

    function salvarCategoriaItemAlterada($dados, $id_categoria_item) {
        $this->db->where('id_categoria_item', $id_categoria_item);
        $this->db->update('categoria_item', $dados);
    }

    function excluirCategoriaItem($id_tipo_item) {
        $this->db->delete('categoria_item', array('id_categoria_item' => $id_tipo_item));
    }

    //put your code here
}

?>
