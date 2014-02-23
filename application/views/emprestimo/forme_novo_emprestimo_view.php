<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('leitores/salvar_leitor') ?>" method="post">
        <fieldset>
            <legend>
                Novo Leitor
            </legend>
           
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="tipo_leitor" class="col-sm-3 control-label"> Tipo de Leitor* </label>
                    <div class="col-sm-8">
                        <select name="tipo_leitor" class="form-control">
                            <?php foreach ($todos_tipos_leitores as $tp) { ?>
                                <option value="<?php echo $tp->id_tipo_leitor ?>" <?php echo set_select('tipo_leitor', $tp->id_tipo_leitor); ?> ><?php echo $tp->nome_tipo_leitor; ?></option>
                            <?php } ?>
                        </select>  
                        <span class="text-danger"> 
                            <?php echo form_error('tipo_leitor'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nome_leitor" class="col-sm-3 control-label"> Nome* </label>
                    <div class="col-sm-8">
                        <input type="text" name="nome_leitor" class="form-control" value="<?php echo set_value('nome_leitor');?>" placeholder="Nome"/>
                        <span class="text-danger"> 
                            <?php echo form_error('nome_leitor'); ?>
                        </span>
                    </div>
                </div>
                  
           </div>   
            
           <div class="col-sm-6">     
                
                <div class="form-group">
                    <label for="nomeMae_leitor" class="col-sm-3 control-label"> Nome da Mãe </label>
                    <div class="col-sm-8">
                        <input type="text" name="nomeMae_leitor" class="form-control" value="<?php echo set_value('nomeMae_leitor');?>" placeholder="Nome da Mãe"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="telefone_leitor" class="col-sm-3 control-label"> Telefone para contato* </label>
                    <div class="col-sm-8">
                        <input type="text" name="telefone_leitor" class="form-control" value="<?php echo set_value('telefone_leitor');?>" placeholder="Telefone"/>
                        <span class="text-danger"> 
                            <?php echo form_error('telefone_leitor'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="<?php echo base_url('leitores')?>" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
               
            </div> 
           

            

        </fieldset>
    </form>

</div>

