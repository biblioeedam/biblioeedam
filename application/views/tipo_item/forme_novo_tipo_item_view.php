<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('tipo_item/salva_tipo_item') ?>" method="post">
        <fieldset>
            <legend>
                Novo Tipo Item
            </legend>
            <div class="form-group">
                <label for="nomeTipoItem" class="col-sm-2 control-label">Nome tipo Item</label>
                <div class="col-sm-10">
                    <input name="nomeTipoItem" class="form-control" id="nomeTipoItem" value="" placeholder="Informe o tipo de item.">
                    <span class="text-danger"> 
                        <?php echo validation_errors(); ?>
                    </span>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('tipo_item')?>" class="btn btn-default">Cancelar</a>
                </div>

            </div>


        </fieldset>
    </form>

</div>
