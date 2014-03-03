<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('item_basico') ?>" method="post">
        <fieldset>
            <legend>
                Busca de Itens
            </legend>
            <span class="text-danger"> 
             (*)são campos obrigatorios
            </span>
            <div class="col-sm-11">
                
                <div class="form-group">
                    <label for="tipoItem" class="col-sm-2 control-label">Tipo*</label>
                    <div class="col-sm-3">
                        <select name="tipoItem" class="form-control" id="tipoItem" >
                            <option value="">Selecione uma Tipo</option>
                            <?php if(!empty($tipo_item)){  ?>
                            <?php foreach ($tipo_item as $ti) { ?>
                            <option value="<?php echo $ti->id_tipo_item ?>"><?php echo $ti->nome_tipo_item ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <span class="text-danger"> 
                            <?php echo form_error('tipoItem'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="categoriaItem" class="col-sm-2 control-label">Categoria</label>
                    <div class="col-sm-3">
                        <select name="categoriaItem" class="form-control" id="categoriaItem" >
                            <option value="">Selecione uma Categoria</option>
                            <?php if(!empty($categoria_item)){  ?>
                            <?php foreach ($categoria_item as $ci){  ?>
                            <option value="<?php echo $ci->id_categoria_item ?>"><?php echo $ci->nome_categoria_item ?> </option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <span class="text-danger"> 
                            <?php echo form_error('categoriaItem'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nome_item" class="col-sm-2 control-label">Nomo do Item</label>
                    <div class="col-sm-3">
                        <input name="nome_item" id="nome_item" class="form-control" id="nome_item" placeholder="Nome do Item"/>
                        <span class="text-danger"> 
                            <?php echo form_error('nome_item'); ?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
          </div>
            
            
        </fieldset>
    </form>

</div>
<div class="col-lg-12">
    
    <table class="table">
        <thead>
            <tr>
                
                <td>Nome</td>
                <td>Registro</td>
                <td>Autor</td>
                <td>Volume</td>
                <td>Prateleira</td>
                <td>Seção</td>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($todos_itens)){  ?>
            <?php foreach ($todos_itens as $ti) { ?>
                <tr>
                    
                    <td><?php echo $ti->nome_item; ?></td>
                    <td><?php echo $ti->numRegistro_item; ?></td>
                    <td><?php echo $ti->autor_item; ?></td>
                    <td><?php echo $ti->volume_item; ?></td>
                    <td><?php echo $ti->nome_prateleira; ?></td>
                    <td><?php echo $ti->nome_secao; ?></td>
                    
                </tr>
            <?php } ?>
                <?php } ?>
        </tbody>
    </table>
</div>
