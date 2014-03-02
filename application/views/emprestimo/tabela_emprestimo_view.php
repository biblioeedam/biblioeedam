<div class="col-lg-12">
    <h3>Emprestimo</h3>

    <a class="btn btn-default" href="<?php echo base_url("emprestimo/novo_emprestimo"); ?>" title="Novo Emprestimo">Novo Emprestimo</a>
    
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

                    <td><a class="btn btn-default" href="<?php echo base_url("emprestimo/ver_itens/".$te->id_acao) ?>"> Ver itens </a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>