<div class="col-lg-12">
    <h3>Prateleira</h3>

    <a class="btn btn-default" href="<?php echo base_url("prateleira/nova_prateleira"); ?>" title="Nova Prateleira"> Nova Prateleira </a>
    <br/>
    <br/>
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>Alterar</td>
                <td>Excluir</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($todas_prateleiras as $tp) { ?>

                <tr>
                    <td><?php echo $tp->id_prateleira ?></td>
                    <td><?php echo $tp->nome_prateleira ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("prateleira/alterar_prateleira/".$tp->id_prateleira) ?>"> Alterar </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("prateleira/excluir_prateleira/".$tp->id_prateleira) ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
