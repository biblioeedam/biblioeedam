<link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery-ui-1.10.4/themes/base/jquery-ui.css">
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.4/ui/jquery-ui.js"></script>

<script>
    $(function() {
        $("#dataDevolucao").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        });
    });
</script>

<style>
    .tamanhoIguais {
        height: 100px;
    }
</style>

<div class="col-lg-12">
    <form class="form-form-actionshorizontal" role="form" action="<?php echo base_url('emprestimo/novo_emprestimo/salvar_emprestimo') ?>" method="post">
        <fieldset class="thumbnail">
            <legend>
                Emprestimo / Itens  
            </legend>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nome Leitor</th>
                        <th>Empréstimo</th>
                        <th>Emprestado em</th>
                        <th>Devolver em</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($emprestimo)) { ?>
                        <?php foreach ($emprestimo as $em) { ?>
                            <tr>

                                <td><?php echo $em->nome_leitor ?></td>
                                <td><?php echo $em->id_acao ?></td>
                                <td><?php echo implode("/",array_reverse(explode("-",$em->data_acao))) ?></td>
                                <td><?php echo implode("/",array_reverse(explode("-",$em->dataDevolucao_acao))) ?></td>


                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
    </form>

</div>
<div class="col-lg-12">
    <h4>
        Itens emprestados
    </h4>
    <table class="table">
        <thead>
            <tr>
                <td>Nome</td>
                <td>Registro</td>
                <td>Autor</td>
                <td>Volume</td>
                <td>Quantidade</td>
                <td>incluir</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($itens_emprestimo)) { ?>
                <?php foreach ($itens_emprestimo as $ti) { ?>
                    <tr>
                        <td><?php echo $ti->nome_item ?></td>
                        <td><?php echo $ti->numRegistro_item ?></td>
                        <td><?php echo $ti->autor_item ?></td>
                        <td><?php echo $ti->volume_item ?></td>
                        <td><?php echo $ti->quantidade_item ?></td>
                        <td><a class="btn btn-primary" href="<?php echo base_url('devolucao/receber/emprestimo/' . $ti->id_acao.'/item/'.$ti->id_item) ?>"> Receber </a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>


