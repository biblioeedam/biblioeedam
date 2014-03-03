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

    function obterTodosItens($qtde=0,$inicio=0) {
        if($qtde >0 ){$this->db->limit($qtde,$inicio);}
        $this->db->where('status_item !=',0);
        $this->db->order_by('id_item','desc');
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
        return $this->db->insert_id();
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
        return $this->db->get('item');
    }
    
    //Obtem itens com os parametros tipo_item e categoria_item
    function obterItem1($id_tipo_item, $id_categoria_item){
        $this->db->select('nome_item,numRegistro_item,autor_item,volume_item,nome_secao,nome_prateleira');
        $this->db->from('item');
        $this->db->join('item_secao_ordem_item','item.id_item = item_secao_ordem_item.id_item');
        $this->db->join('secao','item_secao_ordem_item.id_secao = secao.id_secao');
        $this->db->join('secao_prateleira','secao.id_secao = secao_prateleira.id_secao');
        $this->db->join('prateleira','secao_prateleira.id_prateleira = prateleira.id_prateleira');
        $this->db->where('id_tipo_item',$id_tipo_item);
        $this->db->where('id_categoria_item',$id_categoria_item);
        return $this->db->get();
    }
    //Obtem itens com os parametros tipo_item e nome_item
    function obterItem2($id_tipo_item, $nome_item){
        $this->db->select('nome_item,numRegistro_item,autor_item,volume_item,nome_secao,nome_prateleira');
        $this->db->from('item');
        $this->db->join('item_secao_ordem_item','item.id_item = item_secao_ordem_item.id_item');
        $this->db->join('secao','item_secao_ordem_item.id_secao = secao.id_secao');
        $this->db->join('secao_prateleira','secao.id_secao = secao_prateleira.id_secao');
        $this->db->join('prateleira','secao_prateleira.id_prateleira = prateleira.id_prateleira');
        $this->db->where('id_tipo_item',$id_tipo_item);
        $this->db->like('nome_item',$nome_item);
        return $this->db->get();
    }
    
    //Obtem itens com os parametros tipo_item, categoria_item e nome_item
    function obterItem3($id_tipo_item,$id_categoria_item,$nome_item){
        $this->db->select('nome_item,numRegistro_item,autor_item,volume_item,nome_secao,nome_prateleira');
        $this->db->from('item');
        $this->db->join('item_secao_ordem_item','item.id_item = item_secao_ordem_item.id_item');
        $this->db->join('secao','item_secao_ordem_item.id_secao = secao.id_secao');
        $this->db->join('secao_prateleira','secao.id_secao = secao_prateleira.id_secao');
        $this->db->join('prateleira','secao_prateleira.id_prateleira = prateleira.id_prateleira');
        $this->db->where('id_tipo_item',$id_tipo_item);
        $this->db->where('id_categoria_item',$id_categoria_item);
        $this->db->like('nome_item',$nome_item);
        return $this->db->get();
    }
    //put your code here
}

?>
