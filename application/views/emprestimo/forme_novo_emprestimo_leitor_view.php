<script type="text/javascript">
    $(document).ready(function() {

        var path = '<?php echo site_url(); ?>';
        $("#cod_leitor").change(function() {
            var cod_leitor = $("#cod_leitor").val();
            $("#nome_leitor").val('Aguarde, carregando...');
            $.post('<?php echo base_url("emprestimo/obter_nome_leitor") ?>', {id_leitor: cod_leitor}, function(response) {
                $("#nome_leitor").val(response);
            });
        });
    });
</script>

<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('emprestimo/liberar_emprestimo') ?>" method="post">
        <fieldset>
            <legend>
                Emprestimos / Leitor
            </legend>

            <div class="col-sm-12"> 

                <div class="form-group col-lg-6">
                    <div class="col-lg-12">
                        <input type="radio" name="opcaoPesquisa" value="codigo"/> Codigo
                        <input type="radio" name="opcaoPesquisa" value="nome"/> Nome
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="cod_leitor" id="cod_leitor" class="form-control" placeholder="Código do Leitor"/>

                    </div>
                    <div  class="col-sm-3 "> <button type="button" class="btn btn-primary">Buscar</button> </div>
                </div>


            </div> 

        </fieldset>
    </form>

</div>
<div class="col-lg-12">
    <table class="table">
        <thead>
            <tr>
                <td>Codigo</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Telefone</td>
                <td>Nome Mãe</td>
                <td>Selecionar</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($todos_leitores)) { ?>
                <?php foreach ($todos_leitores as $tl) { ?>
                    <tr>
                        <td><?php echo $tl->id_leitor ?></td>
                        <td><?php echo $tl->nome_leitor ?></td>
                        <td><?php echo $tl->email_leitor ?></td>
                        <td><?php echo $tl->telefone_leitor ?></td>
                        <td><?php echo $tl->nomeMae_leitor ?></td>
                        <td><a class="btn" href="<?php echo base_url('emprestimo/novo_emprestimo/selecionar_leitor/' . $tl->id_leitor) ?>">Selecionar</a></td>


                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>


