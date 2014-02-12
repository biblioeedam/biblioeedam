<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('leitores_basico/salvar_leitor') ?>" method="post">
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
                  
                <div class="form-group">
                    <label for="cpf_leitor" class="col-sm-3 control-label"> CPF </label>
                    <div class="col-sm-8">
                        <input type="text" name="cpf_leitor" class="form-control" value="<?php echo set_value('cpf_leitor');?>" placeholder="CPF"/>
                        <span class="text-danger"> 
                            <?php echo form_error('cpf_leitor'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email_leitor" class="col-sm-3 control-label"> E-mail </label>
                    <div class="col-sm-8">
                        <input type="text" name="email_leitor" class="form-control" value="<?php echo set_value('email_leitor');?>" placeholder="E-mail"/>
                        <span class="text-danger"> 
                            <?php echo form_error('email_leitor'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="repita_email_leitor" class="col-sm-3 control-label"> Repita o e-mail </label>
                    <div class="col-sm-8">
                        <input type="text" name="repita_email_leitor" class="form-control" value="<?php echo set_value('repita_email_leitor');?>" placeholder="Repita o e-mail"/>
                        <span class="text-danger"> 
                            <?php echo form_error('repita_email_leitor'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="serie_leitor" class="col-sm-3 control-label"> Serie </label>
                    <div class="col-sm-8">
                        <input type="text" name="serie_leitor" class="form-control" value="<?php echo set_value('serie_leitor');?>" placeholder="Serie"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="turma_leitor" class="col-sm-3 control-label"> Turma </label>
                    <div class="col-sm-8">
                        <input type="text" name="turma_leitor" class="form-control" value="<?php echo set_value('turma_leitor');?>" placeholder="Turma"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="turno_leitor" class="col-sm-3 control-label"> Turno </label>
                    <div class="col-sm-8">
                        <input type="text" name="turno_leitor" class="form-control" value="<?php echo set_value('turno_leitor');?>" placeholder="Turno"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nomePai_leitor" class="col-sm-3 control-label"> Nome do Pai </label>
                    <div class="col-sm-8">
                        <input type="text" name="nomePai_leitor" class="form-control" value="<?php echo set_value('nomePai_leitor');?>" placeholder="Nome do Pai"/>
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
                    <label for="rua_residencia_leitor" class="col-sm-3 control-label"> Nome da Rua </label>
                    <div class="col-sm-8">
                        <input type="text" name="rua_residencia_leitor" class="form-control" value="<?php echo set_value('rua_residencia_leitor');?>" placeholder="Nome da Rua"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="numero_residencia_leitor" class="col-sm-3 control-label"> Numero </label>
                    <div class="col-sm-8">
                        <input type="text" name="numero_residencia_leitor" class="form-control" value="<?php echo set_value('numero_residencia_leitor');?>" placeholder="Número da Residência"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="bairro_residencia_leitor" class="col-sm-3 control-label"> Bairro </label>
                    <div class="col-sm-8">
                        <input type="text" name="bairro_residencia_leitor" class="form-control" value="<?php echo set_value('bairro_residencia_leitor');?>" placeholder="Bairro"/>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="cidade_leitor" class="col-sm-3 control-label"> Cidade* </label>
                    <div class="col-sm-8">
                        <input type="text" name="cidade_leitor" class="form-control" value="<?php echo set_value('cidade_leitor');?>" placeholder="Cidade"/>
                        <span class="text-danger"> 
                            <?php echo form_error('cidade_leitor'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="distrito_leitor" class="col-sm-3 control-label"> Distrito </label>
                    <div class="col-sm-8">
                        <input type="text" name="distrito_leitor" class="form-control" value="<?php echo set_value('distrito_leitor');?>" placeholder="Distrito"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="referencia_residencia_leitor" class="col-sm-3 control-label"> Referência</label>
                    <div class="col-sm-8">
                        <input type="text" name="referencia_residencia_leitor" class="form-control" value="<?php echo set_value('referencia_residencia_leitor');?>" placeholder="Referência"/>
                    </div>
                </div>
               
                <div class="form-group">
                <div class="col-sm-offset-3 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('leitores_basico')?>" class="btn btn-default">Cancelar</a>
                </div>
            </div>
               
            </div> 
           

            

        </fieldset>
    </form>

</div>

