
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

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
    <form class="form-horizontal" role="form" action="<?php echo base_url('emprestimo/novo_emprestimo/salvar_emprestimo') ?>" method="post">
        <fieldset>
            <legend>
                Emprestimos / Item  
            </legend>

            <div class="col-sm-3 thumbnail tamanhoIguais">
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
            <div class="col-sm-3 thumbnail tamanhoIguais">

                <strong>Item emprestado</strong>

                <?php if (!empty($this->session->userdata("item_emprestimo"))) { ?>
                    <a class = "btn" href ="<?php echo base_url("emprestimo/novo_emprestimo/cacelar_itens_emprestimo") ?> "> Limpar </a >
                    <p style="height: 50px; overflow: auto;">
                        <?php
                        $item_em_emprestimo = $this->session->userdata("item_emprestimo");

                        foreach ($item_em_emprestimo as $iee) {
                            echo $iee['id_item'] . " | " . $iee['nome_item'] . "<br/>";
                        }
                        ?>
                    </p>
                    <?php
                }
                ?>
            </div>   

            <div class="col-sm-3 thumbnail tamanhoIguais">   




                <div class="form-group">
                    <div class="col-sm-5"> <strong> Data do Emprestimo </strong> </div>
                    <div class="col-sm-7"> <strong> Data de Devolução </strong> </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-5 "> <?php echo $dtAtual; ?> </div>
                    <div class="col-sm-7">
                        <input type="text" id="dataDevolucao" name="dt_devolucao" class="form-control"  placeholder="00/00/0000"/>

                    </div>
                </div>
            </div> 
            <div class="col-sm-3 thumbnail tamanhoIguais">
                <div class="form-group">
                    <br/>
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
                <td>Volume</td>
                <td>Quantidade</td>
                <td>Disponível</td>
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
                        <td><?php echo $ti->volume_item ?></td>
                        <td><?php echo $ti->quantidade_item ?></td>
                        <td><?php
                            if ($ti->disponivel_item > 1) {
                                echo $ti->disponivel_item;
                            } else {
                                ?>
                                <span class="text-danger"><?php echo $ti->disponivel_item; ?></span>
                                <?php
                            }
                            ?></td>

                        <td><a class="btn btn-primary" href="<?php echo base_url('emprestimo/novo_emprestimo/incluir_item/' . $ti->id_item) ?>">incluir</a></td>
                    </tr>
                <?php  } ?>
<?php } ?>
        </tbody>
    </table>
</div>


