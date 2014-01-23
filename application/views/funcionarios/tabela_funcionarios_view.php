<div class="col-lg-12">
    <h3>Funcionarios</h3>

    <a class="btn btn-default" href="<?php echo base_url("funcionarios/novo_funcionario"); ?>" title="Novo Funcionario">Novo Funcionario</a>
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
</div>