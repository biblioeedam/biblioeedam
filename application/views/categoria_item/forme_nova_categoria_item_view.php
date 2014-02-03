<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('categoria_item/salva_categoria_item') ?>" method="post">
        <fieldset>
            <legend>
                Nova Categoria Item
            </legend>
            <div class="form-group">
                <label for="nomeCategoriaItem" class="col-sm-2 control-label">Nome Categoria Item</label>
                <div class="col-sm-10">
                    <input name="nomeCategoriaItem" class="form-control" id="nomeCategoriaItem" value="" placeholder="Informe o Categoria de item.">
                    <span class="text-danger"> 
                        <?php echo validation_errors(); ?>
                    </span>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('categoria_item')?>" class="btn btn-default">Cancelar</a>
                </div>

            </div>


        </fieldset>
    </form>

</div>
