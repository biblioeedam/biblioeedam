<div class="col-lg-12">
    <h3>Tipo Item</h3>

    <a class="btn btn-default" href="<?php echo base_url("tipo_item/novo_tipo_item"); ?>" title="Novo Tipo Item"> Novo Tipo Item </a>
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

            <?php foreach ($todos_tipos_itens as $tti) { ?>

                <tr>
                    <td><?php echo $tti->id_tipo_item ?></td>
                    <td><?php echo $tti->nome_tipo_item ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("tipo_item/alterar_tipo_item/".$tti->id_tipo_item) ?>"> Alterar </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("tipo_item/excluir_tipo_item/".$tti->id_tipo_item) ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
