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
    <form class="form-horizontal" role="form" action="<?php echo base_url('emprestimo/novo_emprestimo/salvar_emprestimo') ?>" method="post">
        <fieldset>
            <legend>
                Emprestimos / Item  
            </legend>

            <div class="col-sm-3 thumbnail">
                <div class="form-group">
                    <div class="col-sm-5 "> <strong> Codigo Leitor </strong> </div>
                    <div class="col-sm-7">
                        <strong> Nome Leitor </strong>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5 "> <?php echo $this->session->userdata('id_leitor') ?> </div>
                    <div class="col-sm-7">
                        <?php echo $this->session->userdata('nome_leitor') ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-3 thumbnail">
                <div class="form-group">
                    <div class="col-sm-5"> Data do Emprestimo </div>
                    <div class="col-sm-7"> Data de Devolução </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-5 "> <?php echo $dtAtual; ?> </div>
                    <div class="col-sm-7">
                        <input type="text" name="dt_devolucao" class="form-control"  placeholder="Data de Devolução"/>

                    </div>
                </div>

            </div>   

            <div class="col-sm-3 thumbnail">   

                <strong>Item emprestado</strong>

                <?php
                if (!empty($this->session->userdata("item_emprestimo"))) {
                    echo '<a class = "btn" href ="' . base_url("emprestimo/novo_emprestimo/cacelar_itens_emprestimo") . '"> Limpar </a ><br/>';
                    $item_em_emprestimo = $this->session->userdata("item_emprestimo");

                    foreach ($item_em_emprestimo as $iee) {
                        echo $iee['id_item']." | ". $iee['nome_item'] . "<br/>";
                    }
                }
                ?>



            </div> 
            <div class="col-sm-3 thumbnail">
                <div class="form-group">
                    <div class="col-sm-5"> <a class="btn btn-default" href="<?php echo base_url("emprestimo/novo_emprestimo/cancelar_emprestimo") ?>">Cancelar</a> </div>
                    <div class="col-sm-7"> <button class="btn btn-primary" type="submit">Salvar</button> </div>
                </div>
            </div>

        </fieldset>
    </form>

</div>
<div class="col-lg-12">
    <h4>
        itens disponiveisl para emprestimo
    </h4>
    <table class="table">
        <thead>
            <tr>

                <td>Nome</td>
                <td>Registro</td>
                <td>Autor</td>
                <td>Origem</td>
                <td>Volume</td>
                <td>incluir</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($todos_itens)) { ?>
                <?php foreach ($todos_itens as $ti) { ?>
                    <tr>

                        <td><?php echo $ti->nome_item ?></td>
                        <td><?php echo $ti->numRegistro_item ?></td>
                        <td><?php echo $ti->autor_item ?></td>
                        <td><?php echo $ti->origem_item ?></td>
                        <td><?php echo $ti->volume_item ?></td>
                        <td><a class="btn" href="<?php echo base_url('emprestimo/novo_emprestimo/incluir_item/' . $ti->id_item) ?>">incluir</a></td>


                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>


