<style>
    table.table-collapsed{
        width: 750px;
    }
</style>
<div class="col-lg-12">
        <fieldset>
        <legend>
            Relatório - Dados Leitor
        </legend>
            
            <span class="text-danger"> 
                <?php validation_errors(); ?>
            </span>
            <table class="table table-bordered table-striped table-collapsed">
                <tbody>
                        <tr>
                            <td>Tipo de Leitor: <?php echo $nome_tipo_leitor; ?></td>
                            <td>Nome da Mãe: <?php echo $nomeMae_leitor; ?></td>
                        </tr>

                        <tr>
                            <td>Nome: <?php echo $nome_leitor;?></td>
                            <td>Telefone para contato: <?php echo $telefone_leitor; ?></td>
                        </tr>
                        <tr>
                            <td>CPF: <?php echo $cpf_leitor; ?></td>                            
                            <td>Nome da Rua: <?php echo $rua_residencia_leitor; ?></td>
                        </tr>
                        <tr>
                            <td>E-mail: <?php echo $email_leitor; ?></td>
                            <td>Numero: <?php echo $numero_residencia_leitor; ?></td>
                        </tr>
                        <tr>
                            <td>Serie: <?php echo $serie_leitor ?></td>
                            <td>Bairro: <?php echo $bairro_residencia_leitor; ?></td>
                        </tr>
                        <tr>
                            <td>Turma: <?php echo $turma_leitor; ?></td>
                            <td>Cidade: <?php echo $cidade_leitor; ?></td>
                        </tr>
                        <tr>
                            <td>Turno: <?php echo $turno_leitor; ?></td>
                            <td>Distrito: <?php echo $distrito_leitor; ?></td>
                        </tr>
                        <tr>
                            <td>Nome do Pai: <?php echo $nomePai_leitor; ?></td>
                            <td>Referência: <?php echo $referencia_residencia_leitor; ?></td>
                        </tr>

                </tbody>
            </table>

             

        </fieldset>

</div>