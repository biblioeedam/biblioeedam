<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('secao/salvar_secao_alterada') ?>" method="post">
        <?php foreach ($secao_alterar as $sa) { ?>
            <input type="hidden" name="idSecao" value="<?php echo $sa->id_secao; ?>"
                   <fieldset>
                <legend>
                    Alterar Seção
                </legend>
                <!--<div class="col-lg-6">-->
                <div class="form-group col-lg-6">
                    <label for="nomeSecao" class="col-sm-3 control-label">Nome Seção</label>
                    <div class="col-sm-5">
                        <input name="nomeSecao" class="form-control" id="nomeSecao" value="<?php echo $sa->nome_secao ?>" placeholder="Informe a nome da seção">
                        <span class="text-danger"> 
                            <?php echo validation_errors(); ?>
                        </span>
                    </div>
                </div>
                <!--</div>-->
                <div class="form-group col-lg-6" >
                    <label class="col-sm-3 control-label">Prateleira</label>
                    <div class="col-sm-5" style="height: 100px; overflow: auto">
                        <?php
                        foreach ($todas_prateleiras as $tp) {
                            $verificarSelecao = FALSE;
                            foreach ($prateleiras_secao as $ps) {
                                if ($tp->nome_prateleira == $ps->nome_prateleira) {
                                    $verificarSelecao = TRUE;
                                }
                            } if ($verificarSelecao == true) {
                                ?>                      

                        <input type="checkbox" name="prateleiras[]" checked="true" value="<?php echo $tp->id_prateleira ?>"> <?php echo $tp->nome_prateleira ?> <br/>
                            <?php } else { ?>
                                <input type="checkbox" name="prateleiras[]" value="<?php echo $tp->id_prateleira ?>"> <?php echo $tp->nome_prateleira ?> <br/>
                            <?php }
                        } ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="<?php echo base_url('secao') ?>" class="btn btn-default">Cancelar</a>
                    </div>

                </div>


            </fieldset>
<?php } ?>
    </form>

</div>

