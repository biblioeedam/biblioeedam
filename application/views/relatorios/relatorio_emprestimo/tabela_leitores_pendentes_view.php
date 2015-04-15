<div class="col-lg-12">
    <h3>Leitores Pendentes</h3>
    
    <br/>
    <table class="table">
        <thead>
            <tr>
                <td>Código</td>
                <td>Nome</td>
                <td>Serie</td>
                <td>Telefone</td>
                <td>Ítens Atrasados</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leitores_pendentes as $rs){ ?>
                <tr>
                    <td><?php echo $rs->id_leitor;?></td>
                    <td><?php echo $rs->nome_leitor;?></td>
                    <td><?php echo $rs->serie_leitor;?></td>
                    <td><?php echo $rs->telefone_leitor;?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("relatorios/lista_itens_atrasados/".$rs->id_leitor) ?>"> Emitir </a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>