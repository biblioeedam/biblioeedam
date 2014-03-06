<script type="text/javascript">
    $(document).ready(function(){
        if("<?php echo $this->session->flashdata('sucesso')?>"){
            alert("<?php echo $this->session->flashdata('sucesso')?>");
        }
    });
</script>
<div class="col-lg-12">
    <form class="form-horizontal" role="form" action="<?php echo base_url('emprestimo/novo_emprestimo/leitor') ?>" method="post">
        <fieldset>
            <legend>
                Emprestimos / Leitor
            </legend>

            <div class="col-sm-12"> 

                <div class="form-group col-lg-6">
                    <div class="col-lg-12">
                        <input type="radio" name="opcaoPesquisaLeitor" value="codigo"/> Codigo
                        <input type="radio" checked="true" name="opcaoPesquisaLeitor" value="nome"/> Nome
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="pesquisaLeitor" id="pesquisaLeitor" class="form-control" placeholder="Presquisa Leitor"/>
                    </div>
                    <div  class="col-sm-3 "> <button type="submit" class="btn btn-primary">Buscar</button> </div>
                </div>
            </div> 

        </fieldset>
    </form>

</div>
<div class="col-lg-12">
    <table class="table">
        <thead>
            <tr>
                <td>Codigo</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Telefone</td>
                <td>Nome Mãe</td>
                <td>Selecionar</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($todos_leitores)) { ?>
                <?php foreach ($todos_leitores as $tl) { ?>
                    <tr>
                        <td><?php echo $tl->id_leitor ?></td>
                        <td><?php echo $tl->nome_leitor ?></td>
                        <td><?php echo $tl->email_leitor ?></td>
                        <td><?php echo $tl->telefone_leitor ?></td>
                        <td><?php echo $tl->nomeMae_leitor ?></td>
                        <td><a class="btn btn-primary" href="<?php echo base_url('emprestimo/novo_emprestimo/selecionar_leitor/' . $tl->id_leitor) ?>">Selecionar</a></td>


                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>


