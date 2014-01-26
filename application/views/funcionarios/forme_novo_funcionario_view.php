
<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('funcionarios/salva_funcionario') ?>" method="post">
        <fieldset>
            <legend>
                Novo Funcionario
            </legend>
            <div class="form-group">
                
                <label for="nome" class="col-sm-2 control-label"> Nome: </label>
                <div class="col-sm-10">
                    <input type="text" name="nome" class="form-control" required />
                </div><br/>
                <label for="login" class="col-sm-2 control-label"> Login: </label>
                <div class="col-sm-10">
                    <input type="text" name="login" class="form-control" required />
                </div><br/>
                <label for="senha" class="col-sm-2 control-label"> Senha: </label>
                <div class="col-sm-10">
                    <input type="password" name="senha" class="form-control" />   
                    <span class="text-danger"> 
                        <?php echo validation_errors(); ?>
                    </span>
                </div>
                <br/>
                <label for="senha2" class="col-sm-2 control-label"> Confirmação de Senha: </label>
                <div class="col-sm-10">
                    <input type="password" name="senha2" class="form-control" required />    
                    <span class="text-danger"> 
                        <?php echo validation_errors(); ?>
                    </span>
                </div>
                <br/>
                
                Tipo de Permissão
                <br/>
                <?php foreach ($todos_privilegios as $tp) { ?>
                <br/>    
                <label for="tipoPermissao" class="col-sm-2 control-label"><?php echo $tp->descricao_privilegio ?></label>
                <div class="col-sm-10"><br/>    
                    <input type="radio" name="tipoPermissao" value="<?php echo $tp->id_privilegio ?>" class="form-control" required />
                </div>
                
                <?php } ?>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('funcionarios')?>" class="btn btn-default">Cancelar</a>
                </div>

            </div>

        </fieldset>
    </form>

</div>

