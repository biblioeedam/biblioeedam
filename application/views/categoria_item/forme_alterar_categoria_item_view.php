<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('categoria_item/salva_categoria_item_alterada') ?>" method="post">
        <input type="hidden" name="idCategoriaItem" value="<?php echo $id_categoria_item ?>"
               <fieldset>
            <legend>
                Alterar Categoria Item
            </legend>
            <div class="form-group">
                <label for="nomeCategoriaItem" class="col-sm-2 control-label">Nome Categoria Item</label>
                <div class="col-sm-10">
                    <input type="text" name="nomeCategoriaItem" class="form-control" id="nomeCategoriaItem" value="<?php echo $nome_categoria_item; ?>" placeholder="Informe a Categoria ">
                    <span class="text-danger"> 
                        <?php echo validation_errors(); ?>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('categoria_item') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </fieldset>
    </form>
</div>
