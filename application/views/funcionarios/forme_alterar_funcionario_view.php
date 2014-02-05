<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('funcionarios/salva_funcionario_alterado/'.$id_funcionario) ?>" method="post">
        <input type="hidden" name="idFuncionario" value="<?php echo $id_funcionario ?>"
        <fieldset>
            <legend>
                Alteração de Funcionario
            </legend>
            
            <span class="text-danger"> 
             (*)são campos obrigatorios
            </span>
          
            
            <div class="col-sm-11">
                 <div class="form-group">
                    <label for="nome" class="col-sm-2 control-label"> Nome* </label>
                    <div class="col-sm-5">
                        <input type="text" name="nome" value="<?php echo $nome_funcionario; ?>" class="form-control" placeholder="Nome do Funcionario"/>
                            <span class="text-danger"> 
                                <?php echo form_error('nome'); ?>
                            </span>
                    </div>
                 </div>

                <div class="form-group">
                    <label for="senha" class="col-sm-2 control-label"> Senha* </label>
                    <div class="col-sm-5">
                        <input type="password" name="senha" class="form-control" value="<?php echo set_value('senha'); ?>" placeholder="Senha"/>  
                            <span class="text-danger"> 
                                <?php echo form_error('senha'); ?>
                            </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="senha2" class="col-sm-2 control-label"> Repita a Senha* </label>
                    <div class="col-sm-5">
                        <input type="password" name="senha2" class="form-control" value="<?php echo set_value('senha2'); ?>" placeholder="Repetir a Senha"/>   
                            <span class="text-danger"> 
                                <?php echo form_error('senha2'); ?>
                            </span>
                    </div>
                </div>

                <div class="form-group col-lg-8" >
                    <label class="col-sm-3 control-label">Tipo de Permissão*</label>
                    <div class="col-sm-5" style="height: 100px; overflow: auto">
                        <div class="col-sm-13">  
                            <?php foreach ($dadosPrivilegios["todos_privilegios"] as $tp) { ?>
                            <input type="radio" name="tipoPermissao" value="<?php echo $tp->id_privilegio ?>"/><?php echo $tp->descricao_privilegio ?><br/>
                            <?php } ?>
                            <span class="text-danger"> 
                                <?php echo form_error('tipoPermissao'); ?>
                            </span>
                        </div>
                    </div>         
                </div>  
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="<?php echo base_url('funcionarios') ?>" class="btn btn-default">Cancelar</a>
                    </div>
                </div>

           </div>
        </fieldset>
    </form>

</div>
