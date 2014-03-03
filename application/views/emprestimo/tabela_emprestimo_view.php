<div class="col-lg-12">
    <h3>Emprestimo</h3>

    <a class="btn btn-default" href="<?php echo base_url("emprestimo/novo_emprestimo/leitor"); ?>" title="Novo Emprestimo">Novo Emprestimo</a>
    
    <form name="form_busca_funcionario" method="post" action="funcionarios"> 
        <div class="col-sm-offset-0 col-sm-0">
            <input type="text" name="nome_busca_funcionario" placeholder="Nome do Funcionario"/> <input type="submit" name="botao" value="Buscar" class="btn btn-primary"/>  
        </div>
    </form>
    
    <br/>
    <br/>
    <table class="table">
        <thead>
            <tr>
                <td>Código</td>
                <td>Data ação</td>
                <td>Leitor</td>
                <td>Ver item</td>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos_emprestimos as $te) { ?>

                <tr>
                    <td><?php echo $te->id_acao ?></td>
                    <td><?php echo $te->data_acao ?></td>
                    <td><?php echo $te->id_leitor ?></td>

                    <td><a class="btn btn-default" href="javascript:void(0)" onclick="Emprestimo.VerItemEmprestimo()"> Ver itens </a></td>
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
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>