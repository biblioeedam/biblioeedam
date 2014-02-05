<div class="col-lg-12">
    <h3>Leitores</h3>

    <a class="btn btn-default" href="<?php echo base_url("leitores/novo_leitor"); ?>" title="Novo Leitor">Novo Leitor</a>
    <br/>
    <br/>
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>Serie</td>
                <td>Cartão</td>
                <td>Alterar</td>
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos_leitores as $tp) { ?>
                <tr>
                    <td><?php echo $tp->id_leitor ?></td>
                    <td><?php echo $tp->nome_leitor ?></td>
                    <td><?php echo $tp->serie_leitor ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("leitores/emitir_cartao_leitor/".$tp->id_leitor) ?>"> Emitir </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("leitores/alterar_leitor/".$tp->id_leitor) ?>"> Alterar </a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>