<style>
    table.table-collapsed{
        width: 750px;
    }
</style>
<div class="col-lg-12">
        <fieldset>
        <legend>
            Relatório - Emprestimos 
        </legend>
            
            <span class="text-danger"> 
                <?php validation_errors(); ?>
            </span>
            <table class="table table-bordered table-striped table-collapsed">
                <tbody>
                        <?php foreach ($itens_atrasados as $ia){ ?>
                            <tr>
                                <td>Codigo do Leitor: <?php echo $ia->id_leitor; ?> </td>                            
                                <td>Nome do Leitor: <?php echo $ia->nome_leitor; ?> </td>
                            </tr>
                            <tr>
                                <td colspan="2">Emprestado em: <?php echo $ia->data_acao; ?></td>
                            </tr>
                            <tr>
                                <td>Codigo do Item: <?php echo $ia->id_item; ?></td>
                                <td>Nome do Item: <?php echo $ia->nome_item; ?></td>
                            </tr>
                        <?php } ?>
                        
                </tbody>
            </table>

             

        </fieldset>

</div>