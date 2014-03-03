<style>
    table.table-collapsed{
        width: 750px;
    }
    @media print{
        #imprimir{
            display: none;
        }
    }
</style>
<div class="col-lg-12">
        <fieldset>
            <legend>
                Empréstimos Atrasados
            </legend>
            <a onclick="print();return false" href="#" id="imprimir"><span class="glyphicon glyphicon-print"></span></a>

            <span class="text-danger"> 
                <?php validation_errors(); ?>
            </span>
            <table class="table table-bordered table-striped table-collapsed">
                <tbody>
                        <?php foreach ($leitor as $lt){ ?>
                            <tr>
                                <td><strong>Codigo do Leitor: <?php echo $lt->id_leitor; ?></strong> </td>                            
                                <td colspan="3"><strong>Nome do Leitor: <?php echo $lt->nome_leitor; ?></strong> </td>
                            </tr>
                        <?php } ?>
                    
                        <?php foreach ($itens_atrasados as $ia){ ?>
                            
                            <tr>
                                <td colspan="3">Emprestado em: <?php echo implode("/",array_reverse(explode("-",$ia->data_acao)));?></td>
                            </tr>
                            <tr>
                                <td>Codigo do Item: <?php echo $ia->id_item; ?></td>
                                <td>Nome do Item: <?php echo $ia->nome_item; ?></td>
                                <td>Data de Devolução: <?php echo implode("/",array_reverse(explode("-",$ia->dataDevolucao_acao)));?></td>
                            </tr>
                     
                        <?php } ?>
                </tbody>
            </table>

             

        </fieldset>

</div>