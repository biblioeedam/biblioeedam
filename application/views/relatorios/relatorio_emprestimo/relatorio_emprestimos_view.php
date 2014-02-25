<!--Tabela de Leitores para Usuários Básicos-->
<div class="col-lg-12">
    <h3>Relatório de Itens que estão Emprestados</h3>

    <table class="table">
        <thead>
            <tr>
                <td>Código do Item</td>
                <td>Nome do Item</td>
                <td>Autor</td>
                <td>Código do Leitor</td>
                <td>Nome do Leitor</td>
                
                <td> Data do Empréstimo</td>
              
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