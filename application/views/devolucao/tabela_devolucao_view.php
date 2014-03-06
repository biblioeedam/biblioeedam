<script type="text/javascript">
    $(document).ready(function(){
        if("<?php echo $this->session->flashdata('sucesso')?>"){
            alert("<?php echo $this->session->flashdata('sucesso')?>");
        }
    });
</script>
<div class="col-lg-12">
    <h3>Devolução</h3>

    <!--<a class="btn btn-default" href="<?php //  echo base_url("emprestimo/novo_emprestimo/leitor"); ?>" title="Novo Emprestimo">Novo Emprestimo</a>-->

    <form name="form_busca_leitor" method="post" action="devolucao"> 
        <div class="col-sm-offset-0 col-sm-0">
            <input type="text" name="nome_leitor" placeholder="Nome do Leitor"/> <input type="submit" name="botao" value="Buscar" class="btn btn-primary"/>  
        </div>
    </form>
    
    <table class="table">
        <thead>
            <tr>
                <td>Código Emprestimo</td> 
                <td>Leitor</td>
                <td>Data ação</td>
               
                <td>Ver item</td>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos_emprestimos as $te) { ?>

                <tr>
                    <td><?php echo $te->id_acao ?></td>
                    <td><?php echo $te->nome_leitor ?></td>
                    <td><?php echo implode("/",array_reverse(explode("-",$te->data_acao))); ?></td>
                    <td><a class="btn btn-default" href="javascript:void(0)" onclick="Emprestimo.verItemEmprestimo('<?php echo $te->id_acao ?>')"> Ver itens </a></td>
                    <td><a class="btn btn-primary" href="<?php echo base_url("devolucao/emprestimo/".$te->id_acao) ?>" > Devolver </a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>
<!--<button type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>-->

<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Itens Emprestimo:</h4>
      </div>
        <div class="modal-body" id="conteudoModelEmprestimo">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> Ok </button>
        
      </div>
    </div>
  </div>
</div>