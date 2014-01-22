<div class="col-lg-12">
    <h3>Pratileira</h3>

    <a class="btn btn-default" href="<?php echo base_url("pratileira/nova_pratileira"); ?>" title="Nova Pratileira"> Nova Pratileira </a>
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
                    <td><?php echo $tp->id_patileira ?></td>
                    <td><?php echo $tp->nome_patileira ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("pratileira/alterar_prateleira/".$tp->id_patileira) ?>"> Alterar </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("pratileira/excluir_prateleira/".$tp->id_patileira) ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
