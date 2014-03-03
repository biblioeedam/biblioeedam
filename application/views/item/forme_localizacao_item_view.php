<style>
    #ordemItemDiv{
        display: none;
    }
</style>
<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('item/salvar_localizacao') ?>" method="post">
        <fieldset>
            <legend>
                Localização
            </legend>  
            <div class="row">
                    <table class="table">
                        <thead>
                            <tr>

                                <td>Nome</td>
                                <td>Registro</td>
                                <td>Autor</td>
                                <td>Origem</td>
                                <td>Volume</td>
                                <td>Editora</td>

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
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            <div class="col-sm-6" id="ordemItemDiv">



                <input name="idItem" type="hidden" id="idItem" value="<?php echo $id_item ?>"/>
                <div class="form-group">
                    <!--<label for="ordemItem" class="col-sm-2 control-label">Ordem</label>-->
                    <div class="col-sm-10">
                        <select name="ordemItem" class="form-control" id="ordemItem" >
                            <option value="a">Selecione uma ordem</option>
                            <?php foreach ($ordem_item as $oi) { ?>
                            <option value="<?php echo $oi->id_ordem_item ?>" selected="b"><?php echo $oi->nome_ordem_item ?> </option>
                            <?php } ?>
                        </select>
                        <span class="text-danger"> 
                            <?php echo form_error('ordemItem'); ?>
                        </span>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="secaoItem" class="col-sm-2 control-label"> Seção</label>
                    <div class="col-sm-10">
                        <select name="secaoItem" class="form-control" id="secaoItem" >
                            <option value="">Selecione uma Seção</option>
                            <?php foreach ($secao_item as $si) { ?>
                                <option value="<?php echo $si->id_secao ?>"><?php echo $si->nome_secao ?></option>
                            <?php } ?>
                        </select>
                        <span class="text-danger"> 
                            <?php echo form_error('secaoItem'); ?>
                        </span>
                    </div>
                </div>
            </div>





            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('item') ?>" class="btn btn-default">Cancelar</a>
                </div>

            </div>


        </fieldset>
    </form>

</div>
