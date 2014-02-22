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
        $this->db->where('status_item !=',0);
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

    // obtendo um item pelo id
    function obterItenSelecionado($id_item) {
        return $this->db->get_where('item', array('id_item' => $id_item));
    }
    
    //Salvando os dados do item
    function salvarItem($dados) {
        $this->db->insert('item', $dados);
    }
    
    // Salvando a localização dos itens
    function salvarItemSecaoOrdemItem($dados) {
        $this->db->insert('item_secao_ordem_item', $dados);
    }

    // função para alterar a tabela item_secao_ordem_item de acordo com o item
    function AlterarItemSecaoOrdemItem($dados, $id_item) {
        $this->db->where('id_item', $id_item);
        $this->db->update('item_secao_ordem_item', $dados);
    }
    // função para salvar as alterações do item
    function salvarItemAlterado($dados, $id_item) {
        $this->db->where('id_item', $id_item);
        $this->db->update('item', $dados);
    }
    
    // excluindo o item de forma logica.
    function excluirItem($dados,$id_item) {
        $this->db->where('id_item', $id_item);
        $this->db->update('item', $dados);
    }

    function obterUmItem($nome_item){
        $this->db->like('nome_item',$nome_item);
        return $this->db->get_where('item');
    }
    //put your code here
}

?>
