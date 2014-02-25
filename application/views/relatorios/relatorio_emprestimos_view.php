<!--Tabela de Leitores para Usuários Básicos-->
<div class="col-lg-12">
    <h3>Relatório de Itens que estão Emprestados</h3>

    <a class="btn btn-default" href="<?php echo base_url("leitores_basico/novo_leitor"); ?>" title="Novo Leitor">Novo Leitor</a>
    
    <form name="form_busca_leitor" method="post" action="leitores_basico"> 
        <div class="col-sm-offset-0 col-sm-0">
            <input type="text" name="nome_busca_leitor" placeholder="Nome do Leitor"/> <input type="submit" name="botao" value="Buscar" class="btn btn-primary"/>  
        </div>
    </form>
    
    <br/>
    <br/>
    <table class="table">
        <thead>
            <tr>
                <td>Código do Item</td>
                <td>Nome do Item</td>
                <td>Autor</td>
                <td> Data do Empréstimo</td>
                <td>Código do Leitor</td>
                <td>Nome do Leitor</td>
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos_leitores as $tp) { ?>
                <tr>
                    <td><?php echo $tp->id_leitor ?></td>
                    <td><?php echo $tp->nome_leitor ?></td>
                    <td><?php echo $tp->serie_leitor ?></td>
                    <td><?php echo $tp->serie_leitor ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("leitores_basico/emitir_cartao_leitor/".$tp->id_leitor) ?>"> Emitir </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("leitores_basico/alterar_leitor/".$tp->id_leitor) ?>"> Alterar </a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>