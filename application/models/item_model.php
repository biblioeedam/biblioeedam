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

    function obterTodasOrdens() {
        return $this->db->get('ordem_item');
    }

    function obterTodasSecoes() {
        return $this->db->get('secao');
    }

    // função retorna um item catastrado na tabela item_secao_ordem_item de acordo com o id do item
    function obterItemSecaoOrdemItem($id_item) {
        return $this->db->get_where('item_secao_ordem_item', array('id_item' => $id_item));
    }

    function verificarCategoriaItemUtilisado($id_categoria_item) {
        $this->db->select_max('id_categoria_item', 'cartegoria_item');
        $this->db->where('id_categoria_item', $id_categoria_item);
        return $query = $this->db->get('item');
    }

    function obterItenSelecionado($id_item) {
        return $this->db->get_where('item', array('id_item' => $id_item));
    }

    function salvarItem($dados) {
        $this->db->insert('item', $dados);
    }

    function salvarItemSecaoOrdemItem($dados) {
        $this->db->insert('item_secao_ordem_item', $dados);
    }

    // função para alterar a tabela item_secao_ordem_item de acordo com o item
    function AlterarItemSecaoOrdemItem($dados, $id_item) {
        $this->db->where('id_item', $id_item);
        $this->db->update('item_secao_ordem_item', $dados);
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
