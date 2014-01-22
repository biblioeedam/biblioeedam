<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('pratileira/salva_pratileira') ?>" method="post">
        <fieldset>
            <legend>
                Nova Pratileira
            </legend>
            <div class="form-group">
                <label for="nomePratileira" class="col-sm-2 control-label">Nome Pratileria</label>
                <div class="col-sm-10">
                    <input name="nomePratileira" class="form-control" id="nomePratileira" value="<?php echo $proxima_pratileira; ?>" placeholder="Informe o numero da pratileira">
                    <span class="text-danger"> 
                        <?php echo validation_errors(); ?>
                    </span>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('pratileira')?>" class="btn btn-default">Cancelar</a>
                </div>

            </div>


        </fieldset>
    </form>

</div>
