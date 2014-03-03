<?php

class Leitores_model extends CI_Model {
 
    function obterTodosLeitores($qtde=0,$inicio=0){
        //parametros de paginação
        if($qtde >0 ){$this->db->limit($qtde,$inicio);}
        $this->db->order_by('nome_leitor','asc');
        return $this->db->get('leitor');
    }
    
    
    function obtertodosleitores2(){
        return $this->db->get('leitor');
    }
            
    function obterUmLeitor($id_leitor) {
        return $this->db->get_where('leitor', array('id_leitor' => $id_leitor));
    }
    
    function obterUmLeitor2($nome_leitor){
        $this->db->like('nome_leitor',$nome_leitor);
        return $this->db->get('leitor');
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
    
    function obterLeitoresPendentes($qtde=0,$inicio=0){
        //parametros de paginção
        if($qtde >0 ){$this->db->limit($qtde,$inicio);}
        $this->db->select('leitor.id_leitor,nome_leitor,serie_leitor,telefone_leitor');
        $this->db->order_by('nome_leitor','asc');
        $this->db->from('leitor');
        $this->db->join('acao','acao.id_leitor = leitor.id_leitor');
        $this->db->where('acao.dataDevolucao_acao <',date('Y-m-d'));
        $this->db->group_by('leitor.id_leitor');
        return $this->db->get();
    }
    
    //Obtem lista de itens atrasados por determinado leitor
    function obterItensAtrasados($id_leitor){
        $this->db->select('leitor.id_leitor, leitor.nome_leitor, item.id_item, item.nome_item, acao.data_acao, acao.dataDevolucao_acao');
        $this->db->from('item');
        $this->db->join('item_acao','item.id_item = item_acao.id_item');
        $this->db->join('acao','item_acao.id_acao = acao.id_acao');
        $this->db->join('leitor','acao.id_leitor = leitor.id_leitor');
        $this->db->where('acao.dataDevolucao_acao <',date('Y-m-d'));
        $this->db->where('acao.id_leitor',$id_leitor);
        $this->db->order_by('item_acao.id_acao');
        return $this->db->get();
    }


    //Criar aqui um metodo para incluir tipos de ação

}
?>
