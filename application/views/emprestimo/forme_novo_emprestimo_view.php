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
                Emprestimos
            </legend>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="cod_leitor" class="col-sm-3 control-label"> Código do Leitor </label>
                    <div class="col-sm-8">
                        <input type="text" name="cod_leitor" id="cod_leitor" class="form-control" placeholder="Código do Leitor"/>
                        <span class="text-danger"> 
                            <?php echo form_error('cod_leitor'); ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_leitor" class="col-sm-3 control-label"> Nome do Leitor </label>
                    <div class="col-sm-8">
                        <input type="text" id="nome_leitor" name="nome_leitor" class="form-control" readonly="true"/>
                        <span class="text-danger"> 
                            <?php echo form_error('nome_leitor'); ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dt_emprestimo" class="col-sm-3 control-label"> Data do Emprestimo </label>
                    <div class="col-sm-8">
                        <input type="text" name="dt_emprestimo" class="form-control" value="<?php echo $dtAtual; ?>" readonly="true"/>
                        <span class="text-danger"> 
                            <?php echo form_error('dt_emprestimo'); ?>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dt_devolucao" class="col-sm-3 control-label"> Data de Devolução </label>
                    <div class="col-sm-8">
                        <input type="text" name="dt_devolucao" class="form-control"  placeholder="Data de Devolução"/>
                        <span class="text-danger"> 
                            <?php echo form_error('dt_devolucao'); ?>
                        </span>
                    </div>
                </div>

            </div>   

            <div class="col-sm-6">   
                
                Item emprestado:
                
<!--
                <div class="form-group">
                    <label for="tipo_item" class="col-sm-3 control-label"> Tipo de Item </label>
                    <div class="col-sm-8">
                        <select name="tipo_item" class="form-control">
                            <?php// foreach ($tipos_item as $tp) { ?>
                                <option value="<?php// echo $tp->id_tipo_item ?>" <?php// echo set_select('tipo_item', $tp->id_tipo_item); ?> ><?php echo $tp->nome_tipo_item; ?></option>
                            <?php // } ?>
                        </select>                          
                        <span class="text-danger"> 
                            <?php// echo form_error('tipo_item'); ?>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cod_item" class="col-sm-3 control-label"> Código do Item </label>
                    <div class="col-sm-8">
                        <input type="text" name="cod_item" class="form-control" value="<?php echo set_value('cod_item'); ?>" placeholder="Código do Item"/>
                        <span class="text-danger"> 
                            <?php// echo form_error('cod_item'); ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vol_item" class="col-sm-3 control-label"> Volume </label>
                    <div class="col-sm-8">
                        <input type="text" name="vol_item" class="form-control" value="<?php echo set_value('vol_item'); ?>" placeholder="Volume"/>
                        <span class="text-danger"> 
                            <?php echo form_error('vol_item'); ?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_item" class="col-sm-3 control-label"> Nome do Item </label>
                    <div class="col-sm-8">
                        <input type="text" name="nome_item" class="form-control" readonly="true"/>
                        <span class="text-danger"> 
                            <?php// echo form_error('nome_item'); ?>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
                        <button type="submit" class="btn btn-primary">Liberar</button>
                    </div>
                </div>-->

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
                        <td><a class="btn" href="<?php echo base_url('emprestimo/incluir_item/'.$ti->id_item) ?>">incluir</a></td>
                        

                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>


