<div class="col-lg-12">
    <h3>Seção</h3>

    <a class="btn btn-default" href="<?php echo base_url("secao/nova_secao"); ?>" title="Nova Secão"> Nova Seção </a>
    <br/>
    <br/>
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>Prateleira</td>
                <td>Alterar</td>
                <td>Excluir</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($todas_secoes as $tp) { ?>

                <tr>
                    <td><?php echo $tp->id_secao ?></td>
                    <td><?php echo $tp->nome_secao ?></td>
                    
                    <td> <?php echo $tp->prateleiras ?> </td>
                    
                    <td><a class="btn btn-default" href="<?php echo base_url("secao/alterar_secao/".$tp->id_secao) ?>"> Alterar </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("secao/excluir_secao/".$tp->id_secao) ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>
