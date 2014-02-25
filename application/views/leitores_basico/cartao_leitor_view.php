<table border="1">
    <tbody>
        <tr>
            <td>Código: <?php echo $id_leitor;?> </td>
            <td>Nome: <?php echo $nome_leitor; ?> </td>
        </tr>    
    <tr>
        <td>Tipo de Leitor: <?php echo $nome_tipo_leitor; ?> </td>
        <td>Fone: <?php echo $telefone_leitor; ?> </td>
        
    </tr>
    <tr>
        <td>Série: <?php echo $serie_leitor; ?> </td>
        <td>Turma: <?php echo $turma_leitor; ?> </td>
    </tr>
    <tr>
        <td>Turno: <?php echo $turno_leitor; ?> </td>
        <td>Emissão: <?php echo $dataAtual; ?></td>
    </tr>
    </tbody>
</table>

<br/>

<table border="1" width="500">
        <thead>
            <tr>
                <td width="90">Código do Livro</td>
                <td width="150">Nome do Livro</td>
                <td width="80">Pegou em</td>
                <td width="80">Devolver em</td>
            </tr>
        </thead>
        <tbody>
            <?php
                for ($i=0; $i<=30; $i++){
                    echo '<tr>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                            <td>.</td>
                          </tr>';
                }   
            ?>
        </tbody>
</table>
        

