<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('item/salvar_item_alterado') ?>" method="post">
        
        <fieldset>
            <legend>
                Alterar Item
            </legend>
            
            <?php foreach ($item as $it) { ?>
            <input name="idItem" type="hidden" value="<?php echo $it->id_item ?>" />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nomeItem" class="col-sm-2 control-label">Nome Item</label>
                        <div class="col-sm-10">
                            <input name="nomeItem" class="form-control" id="nomeItem" value="<?php echo $it->nome_item; ?>" placeholder="Informe o item.">
                            <span class="text-danger"> 
                                <?php echo form_error('nomeItem'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="numeroRegistroItem" class="col-sm-2 control-label">Numero Registro</label>
                        <div class="col-sm-10">
                            <input name="numeroRegistroItem" class="form-control" id="numeroRegistroItem" value="<?php echo $it->numRegistro_item; ?>" placeholder="Numero registro">
                            <span class="text-danger"> 
                                <?php echo form_error('numeroRegistroItem'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="autorItem" class="col-sm-2 control-label">Autor</label>
                        <div class="col-sm-10">
                            <input name="autorItem" class="form-control" id="autorItem" value="<?php echo $it->autor_item; ?>" placeholder="Autor">
                            <span class="text-danger"> 
                                <?php echo form_error('autorItem'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="origemItem" class="col-sm-2 control-label">Origem</label>
                        <div class="col-sm-10">
                            <input name="origemItem" class="form-control" id="origemItem" value="<?php echo $it->origem_item; ?>" placeholder="Origem">
                            <span class="text-danger"> 
                                <?php echo form_error('origemItem'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="volumeItem" class="col-sm-2 control-label">Volume</label>
                        <div class="col-sm-10">
                            <input name="volumeItem" class="form-control" id="volumeItem" value="<?php echo $it->volume_item; ?>" placeholder="Volume">
                            <span class="text-danger"> 
                                <?php echo form_error('volumeItem'); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="editoraItem" class="col-sm-2 control-label">Editora</label>
                        <div class="col-sm-10">
                            <input name="editoraItem" class="form-control" id="editoraItem" value="<?php echo $it->editora_item; ?>" placeholder="Editora">
                            <span class="text-danger"> 
                                <?php echo form_error('editoraItem'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descricaoItem" class="col-sm-2 control-label">Descrição</label>
                        <div class="col-sm-10">
                            <input name="descricaoItem" class="form-control" id="descricaoItem" value="<?php echo $it->descricao_item ?>" placeholder="Descrição">
                            <span class="text-danger"> 
                                <?php echo form_error('descricaoItem'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dataLancamentoItem" class="col-sm-2 control-label">Data Lancamente</label>
                        <div class="col-sm-10">
                            <input name="dataLancamentoItem" type="date" class="form-control" id="dataLancamentoItem" value="<?php echo $it->dataLancamento_item; ?>" placeholder="Data Lançamento">
                            <span class="text-danger"> 
                                <?php echo form_error('dataLancamentoItem'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="categoriaItem" class="col-sm-2 control-label">Categoria</label>
                        <div class="col-sm-10">
                            <select name="categoriaItem" class="form-control" id="categoriaItem" >
                                <option value="">Selecione uma Categoria</option>
                                <?php
                                foreach ($categoria_item as $ci) {
                                    if ($ci->id_categoria_item == $it->id_categoria_item) {
                                        ?>
                                        <option selected="true" value="<?php echo $ci->id_categoria_item ?>"><?php echo $ci->nome_categoria_item ?> </option>

                                    <?php } else { ?>
                                        <option value="<?php echo $ci->id_categoria_item ?>"><?php echo $ci->nome_categoria_item ?> </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"> 
                                <?php echo form_error('categoriaItem'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipoItem" class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-10">
                            <select name="tipoItem" class="form-control" id="tipoItem" >
                                <option value="">Selecione uma Tipo</option>
                                
                                
                                <?php
                                foreach ($tipo_item as $ti) {
                                    if ($ti->id_tipo_item == $it->id_tipo_item) {
                                        ?>
                                        <option selected="true" value="<?php echo $ti->id_tipo_item ?>"><?php echo $ti->nome_tipo_item ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $ti->id_tipo_item ?>"><?php echo $ti->nome_tipo_item ?></option>
                                        
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"> 
                                <?php echo form_error('tipoItem'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qtdItem" class="col-sm-2 control-label">Quantidade</label>
                        <div class="col-sm-10">
                            <input name="qtdItem" class="form-control" id="qtdItem" value="<?php echo $it->quantidade_item; ?>" placeholder="Quantidade de Itens">
                            <span class="text-danger"> 
                                <?php echo form_error('qtdItem'); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="<?php echo base_url('item') ?>" class="btn btn-default">Cancelar</a>
                    </div>

                </div>

            <?php } ?>
        </fieldset>
    </form>

</div>
