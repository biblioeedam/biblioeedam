<script type="text/javascript">
    $(document).ready(function(){
        if("<?php echo $this->session->flashdata('sucesso')?>"){
            alert("<?php echo $this->session->flashdata('sucesso')?>");
        }
    });
</script>
<div class="col-lg-12">
    <h3>Categoria Item</h3>

    <a class="btn btn-default" href="<?php echo base_url("categoria_item/nova_categoria_item"); ?>" title="Nova Categoria Item"> Nova Categoria Item </a>
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

            <?php foreach ($todas_categorias_itens as $tci) { ?>

                <tr>
                    <td><?php echo $tci->id_categoria_item ?></td>
                    <td><?php echo $tci->nome_categoria_item ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("categoria_item/alterar_categoria_item/".$tci->id_categoria_item) ?>"> Alterar </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("categoria_item/excluir_categoria_item/".$tci->id_categoria_item) ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>
