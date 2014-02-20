<div class="col-lg-12">
    <h3>Funcionarios</h3>

    <a class="btn btn-default" href="<?php echo base_url("funcionarios/novo_funcionario"); ?>" title="Novo Funcionario">Novo Funcionario</a>
    
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
                <td>Id</td>
                <td>Nome</td>
                <td>Login</td>
                <td>Alterar</td>
                <td>Excluir</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos_funcionarios as $tp) { ?>

                <tr>
                    <td><?php echo $tp->id_funcionario ?></td>
                    <td><?php echo $tp->nome_funcionario ?></td>
                    <td><?php echo $tp->login_funcionario ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("funcionarios/alterar_funcionario/".$tp->id_funcionario) ?>"> Alterar </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("funcionarios/excluir_funcionario/".$tp->id_funcionario) ?>"> Excluir </a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>