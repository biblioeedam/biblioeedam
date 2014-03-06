<div class="col-lg-12">
    <h3>Busque pelo Leitor</h3>
    
    <form name="form_busca_leitor" method="post" action="busca_leitor"> 
        <div class="col-sm-offset-0 col-sm-0">
            <input type="text" name="nome_busca_leitor" placeholder="Nome do Leitor"/> <input type="submit" name="botao" value="Buscar" class="btn btn-primary"/>  
        </div>
    </form>
    
    <br/>
    
    <table class="table">
        <thead>
            <tr>
                <td>Código</td>
                <td>Nome</td>
                <td>Serie</td>
                <td>Relatório de Dados</td>
              
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($todos_leitores)){   ?>
            <?php foreach ($todos_leitores as $tp) { ?>
                <tr>
                    <td><?php echo $tp->id_leitor ?></td>
                    <td><?php echo $tp->nome_leitor ?></td>
                    <td><?php echo $tp->serie_leitor ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("relatorios/dados_leitor/".$tp->id_leitor) ?>"> Emitir </a></td>
                    
                </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>