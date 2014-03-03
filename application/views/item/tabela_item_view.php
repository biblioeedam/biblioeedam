<div class="col-lg-12">
    <h3>Item</h3>

    <a class="btn btn-default" href="<?php echo base_url("item/novo_item"); ?>" title="Novo Item"> Novo Item </a>
    <br/>
    <br/>
    <table class="table">
        <thead>
            <tr>
                
                <td>Nome</td>
                <td>Registro</td>
                <td>Autor</td>
                <td>Origem</td>
                <td>Volume</td>
                <td>Editora</td>
                <td>Localização</td>
                <td>Alterar</td>
                <td>Excluir</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($todos_itens as $ti) { ?>
                <tr>
                    
                    <td><?php echo $ti->nome_item ?></td>
                    <td><?php echo $ti->numRegistro_item ?></td>
                    <td><?php echo $ti->autor_item ?></td>
                    <td><?php echo $ti->origem_item ?></td>
                    <td><?php echo $ti->volume_item ?></td>
                    <td><?php echo $ti->editora_item ?></td>
                    
                    <td><a class="btn btn-default" href="<?php echo base_url("item/localizacao_item/".$ti->id_item) ?>"> Localização </a></td>
                    
                    <td><a class="btn btn-default" href="<?php echo base_url("item/alterar_item/".$ti->id_item) ?>"> Alterar </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("item/excluir_item/".$ti->id_item) ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>
