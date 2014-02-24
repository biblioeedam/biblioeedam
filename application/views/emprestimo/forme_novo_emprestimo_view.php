<script src="../../../js/jquery.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var path = '<?php echo site_url(); ?>';
        $("input[name='cod_leitor']").change(function(){
            var cod_leitor = $("input[name='cod_leitor']");
            var nome_leitor = $("input[name=nome_leitor]");
            $( nome_leitor ).val('Aguarde, carregando...');
            $.getJSON( path + '/emprestimo/obter_nome_leitor/' + cod_leitor, function (data){
                function(data){
                    alert('oi');
                    $( nome_leitor ).val(data.nome_leitor);
                }
            );
        });
    });
</script>

<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('leitores/salvar_leitor') ?>" method="post">
        <fieldset>
            <legend>
                Emprestimos
            </legend>
           
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="cod_leitor" class="col-sm-3 control-label"> Código Leitor </label>
                    <div class="col-sm-8">
                        <input type="text" name="cod_leitor" class="form-control" placeholder="Código do Leitor"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_leitor" class="col-sm-3 control-label"> Nome do Leitor </label>
                    <div class="col-sm-8">
                        <input type="text" name="nome_leitor" class="form-control" readonly="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dt_emprestimo" class="col-sm-3 control-label"> Data do Emprestimo </label>
                    <div class="col-sm-8">
                        <input type="text" name="dt_emprestimo" class="form-control" readonly="true"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="dt_emprestimo" class="col-sm-3 control-label"> Data de Devolução </label>
                    <div class="col-sm-8">
                        <input type="text" name="dt_emprestimo" class="form-control" value="<?php ?>" placeholder="Data de Devolução"/>
                    </div>
                </div>
                  
           </div>   
            
           <div class="col-sm-6">   
               
               <div class="form-group">
                    <label for="tipo_leitor" class="col-sm-3 control-label"> Tipo de Item </label>
                    <div class="col-sm-8">
                        <select name="tipo_leitor" class="form-control">
                            <?php foreach ($todos_tipos_leitores as $tp) { ?>
                                <option value="<?php echo $tp->id_tipo_leitor ?>" <?php echo set_select('tipo_leitor', $tp->id_tipo_leitor); ?> ><?php echo $tp->nome_tipo_leitor; ?></option>
                            <?php } ?>
                        </select>                          
                        <span class="text-danger"> 
                            <?php echo form_error('nome_leitor'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="telefone_leitor" class="col-sm-3 control-label"> Código Item </label>
                    <div class="col-sm-8">
                        <input type="text" name="telefone_leitor" class="form-control" value="<?php echo set_value('telefone_leitor');?>" placeholder="Código do Item"/>
                        <span class="text-danger"> 
                            <?php echo form_error('telefone_leitor'); ?>
                        </span>
                    </div>
                </div>
               <div class="form-group">
                    <label for="telefone_leitor" class="col-sm-3 control-label"> Volume </label>
                    <div class="col-sm-8">
                        <input type="text" name="telefone_leitor" class="form-control" value="<?php echo set_value('telefone_leitor');?>" placeholder="Volume"/>
                        <span class="text-danger"> 
                            <?php echo form_error('telefone_leitor'); ?>
                        </span>
                    </div>
                </div>
               <div class="form-group">
                    <label for="dt_emprestimo" class="col-sm-3 control-label"> Nome do Item </label>
                    <div class="col-sm-8">
                        <input type="text" name="dt_emprestimo" class="form-control" readonly="true"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
                        <button type="submit" class="btn btn-primary">Liberar</button>
                    </div>
                </div>
               
            </div> 
           

            

        </fieldset>
    </form>

</div>
<div class="col-lg-12">
    <h4>
    Últimos Empréstimos Realizados
    </h4>
    <table class="table">
        <thead>
            <tr>
                
                <td>Nome</td>
                <td>Registro</td>
                <td>Autor</td>
                <td>Origem</td>
                <td>Volume</td>
                <td>Seção</td>
                <td>Prateleira</td>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($todos_itens)){  ?>
            <?php foreach ($todos_itens as $ti) { ?>
                <tr>
                    
                    <td><?php echo $ti->nome_item ?></td>
                    <td><?php echo $ti->numRegistro_item ?></td>
                    <td><?php echo $ti->autor_item ?></td>
                    <td><?php echo $ti->origem_item ?></td>
                    <td><?php echo $ti->volume_item ?></td>
                    <td><?php echo $ti->volume_item ?></td>
                    <td><?php echo $ti->volume_item ?></td>
                    
                </tr>
            <?php } ?>
                <?php } ?>
        </tbody>
    </table>
</div>


