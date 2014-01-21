<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
   <div>
       Usuários Cadastrados
        <ul>
        <?php
        
            foreach ($funcionario as $a){
                
                echo '<li>';
                echo anchor("funcionarios/apagarFuncionario/$a->id_funcionario",'Apagar - ');
                echo $a->nome_funcionario.'&nbsp; &nbsp; / &nbsp;'.$a->login_funcionario;
                
                echo '</li>';
                
            }
        
        
        ?>
        </ul>
    </div> 
    
    <form name="frmCadastroFuncionario" action="<?php echo base_url()."funcionarios/cadastrarFuncionario" ?>" method="post">
        <fieldset>

            <legend> Cadastrar Funcionário </legend>
            <span class="text-error"> 
            </span>
            <label> Nome: </label>
            <input type="text" name="nome" class="form-control" required /><br/>
            <label> Login: </label>
            <input type="text" name="login" class="form-control" required /><br/>
            <label> Senha: </label>
            <input type="password" name="senha" class="form-control" required />                        
            <br/>
            <label> Confirme a Senha: </label>
            <input type="password" name="senha2" class="form-control" required />                        
            <br/>
            <input type="submit" name="acao" class="btn pull-right btn-primary" value="Cadastrar"/>

        </fieldset>
    </form>


</body>
</html>