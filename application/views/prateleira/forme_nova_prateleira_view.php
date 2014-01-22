<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('prateleira/salva_prateleira') ?>" method="post">
        <fieldset>
            <legend>
                Nova Prateleira
            </legend>
            <div class="form-group">
                <label for="nomePrateleira" class="col-sm-2 control-label">Nome Prateleria</label>
                <div class="col-sm-10">
                    <input name="nomePrateleira" class="form-control" id="nomePrateleira" value="<?php echo $proxima_prateleira; ?>" placeholder="Informe o numero da prateleira">
                    <span class="text-danger"> 
                        <?php echo validation_errors(); ?>
                    </span>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('prateleira')?>" class="btn btn-default">Cancelar</a>
                </div>

            </div>


        </fieldset>
    </form>

</div>
