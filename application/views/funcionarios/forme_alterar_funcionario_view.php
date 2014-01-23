<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('funcionarios/salva_funcionario_alterado') ?>" method="post">
        <input type="hidden" name="idFuncionario" value="<?php echo $id_funcionario ?>"
        <fieldset>
        <legend>
            Alteração de Funcionario
        </legend>
        <div class="form-group">
                <span class="text-error"> 
                </span>
                <label> Nome: </label>
                <input type="text" name="nome" value="<?php echo $nome_funcionario;?>" class="form-control" required /><br/>
                <label> Login: </label>
                <input type="text" name="login"  value="<?php echo $login_funcionario;?>" class="form-control" required /><br/>
                <label> Senha: </label>
                <input type="password" name="senha" class="form-control" required />                        
                <br/>
                <label> Confirme a Senha: </label>
                <input type="password" name="senha2" class="form-control" required />                        
                <br/>
                <label> Tipo de Permissão</label><br/>
                <label>Usuário Normal:</label>
                <input type="radio" name="tipoPermissao" value="n" class="form-control" required />
                <label>Super Usuário:</label>
                <input type="radio" name="tipoPermissao" value="s" class="form-control" required />
        </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('funcionarios') ?>" class="btn btn-default">Cancelar</a>
            </div>

            </div>


        </fieldset>
    </form>

</div>
