<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('leitores/salvar_leitor_alterado') ?>" method="post">
        <input type="hidden" name="id_leitor" value="<?php echo $id_leitor ?>"
        <fieldset>
        <legend>
            Alterar Dados de Leitor
        </legend>
        <div class="form-group">
                <label for="tipo_leitor" class="col-sm-2 control-label"> Tipo de Leitor: </label>
                <div class="col-sm-10">
                    <select name="tipo_leitor" class="form-control">
                        <?php foreach ($tipos_leitores[todos_tipos_leitores] as $tp) { ?>
                            <option value="<?php echo $tp->id_tipo_leitor ?>"><?php echo $tp->nome_tipo_leitor; ?></option>

                        <?php } ?>
                    </select>    
                </div>
                <br/>
                
                <label for="nome_leitor" class="col-sm-2 control-label"> Nome: </label>
                <div class="col-sm-10">
                    <input type="text" name="nome_leitor" value="<?php echo $nome_leitor; ?>" class="form-control" required />
                </div>
                <br/>
                                                
                <label for="cpf_leitor" class="col-sm-2 control-label"> CPF: </label>
                <div class="col-sm-10">
                    <input type="text" name="cpf_leitor" value="<?php echo $cpf_leitor; ?>" class="form-control"/>
                </div>
                <br/>
                
                <label for="email_leitor" class="col-sm-2 control-label"> E-mail: </label>
                <div class="col-sm-10">
                    <input type="text" name="email_leitor" value="<?php echo $email_leitor; ?>" class="form-control" />
                </div>
                <br/>
                
                <label for="serie_leitor" class="col-sm-2 control-label"> Serie: </label>
                <div class="col-sm-10">
                    <input type="text" name="serie_leitor" value="<?php echo $serie_leitor ?>" class="form-control" />
                </div>
                <br/>
                
                <label for="turno_leitor" class="col-sm-2 control-label"> Turno: </label>
                <div class="col-sm-10">
                    <input type="text" name="turno_leitor" value="<?php echo $turno_leitor; ?>" class="form-control" />
                </div>
                <br/>
                
                <label for="turma_leitor" class="col-sm-2 control-label"> Turma: </label>
                <div class="col-sm-10">
                    <input type="text" name="turma_leitor" value="<?php echo $turma_leitor; ?>" class="form-control" />
                </div>
                <br/>
                
                <label for="nomePai_leitor" class="col-sm-2 control-label"> Nome do Pai: </label>
                <div class="col-sm-10">
                    <input type="text" name="nomePai_leitor" value="<?php echo $nomePai_leitor; ?>" class="form-control" />
                </div>
                <br/>
                
                <label for="nomeMae_leitor" class="col-sm-2 control-label"> Nome da Mãe: </label>
                <div class="col-sm-10">
                    <input type="text" name="nomeMae_leitor" value="<?php echo $nomeMae_leitor; ?>" class="form-control" />
                </div>
                <br/>
                
                <label for="telefone_leitor" class="col-sm-2 control-label"> Telefone para contato: </label>
                <div class="col-sm-10">
                    <input type="text" name="telefone_leitor" value="<?php echo $telefone_leitor; ?>" class="form-control" required />
                </div>
                <br/>
                
                <label for="rua_residencia_leitor" class="col-sm-2 control-label"> Nome da Rua: </label>
                <div class="col-sm-10">
                    <input type="text" name="rua_residencia_leitor" value="<?php echo $rua_residencia_leitor; ?>" class="form-control"/>
                </div>
                <br/>
                
                <label for="numero_residencia_leitor" class="col-sm-2 control-label"> Numero: </label>
                <div class="col-sm-10">
                    <input type="text" name="numero_residencia_leitor" value="<?php echo $numero_residencia_leitor; ?>" class="form-control"/>
                </div>
                <br/>
                
                <label for="bairro_residencia_leitor" class="col-sm-2 control-label"> Bairro: </label>
                <div class="col-sm-10">
                    <input type="text" name="bairro_residencia_leitor" value="<?php echo $bairro_residencia_leitor; ?>" class="form-control"/>
                </div>
                <br/>
                
                <label for="cidade_leitor" class="col-sm-2 control-label"> Cidade: </label>
                <div class="col-sm-10">
                    <input type="text" name="cidade_leitor" value="<?php echo $cidade_leitor; ?>" class="form-control" required />
                </div>
                <br/>
                
                <label for="distrito_leitor" class="col-sm-2 control-label"> Distrito: </label>
                <div class="col-sm-10">
                    <input type="text" name="distrito_leitor" value="<?php echo $distrito_leitor; ?>" class="form-control"/>
                </div>
                <br/>

                <label for="referencia_residencia_leitor" class="col-sm-2 control-label"> Referência: </label>
                <div class="col-sm-10">
                    <input type="text" name="referencia_residencia_leitor" value="<?php echo $referencia_residencia_leitor; ?>" class="form-control"/>
                </div>
                <br/>
               
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="<?php echo base_url('leitores') ?>" class="btn btn-default">Cancelar</a>
            </div>

            </div>


        </fieldset>
    </form>

</div>
