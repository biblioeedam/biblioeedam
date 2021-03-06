<script type="text/javascript">
    $(document).ready(function(){
        if("<?php echo $this->session->flashdata('sucesso')?>"){
            alert("<?php echo $this->session->flashdata('sucesso')?>");
        }
    });
</script>
<div class="col-lg-12">
    <h3>Leitores</h3>
    
    <a class="btn btn-default" href="<?php echo base_url("leitores/novo_leitor"); ?>" title="Novo Leitor">Novo Leitor</a>
     
    <form name="form_busca_leitor" method="post" action="leitores"> 
        <div class="col-sm-offset-0 col-sm-0">
            <input type="text" name="nome_busca_leitor" placeholder="Nome do Leitor"/> <input type="submit" name="botao" value="Buscar" class="btn btn-primary"/>  
        </div>
    </form>
    <br/>
    
    <br/>
    <table class="table">
        <thead>
            <tr>
                <td>Código</td>
                <td>Nome</td>
                <td>Serie</td>
                <td>Cartão</td>
                <td>Alterar</td>
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos_leitores as $tp) { ?>
                <tr>
                    <td><?php echo $tp->id_leitor ?></td>
                    <td><?php echo $tp->nome_leitor ?></td>
                    <td><?php echo $tp->serie_leitor ?></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("leitores/emitir_cartao_leitor/".$tp->id_leitor) ?>"> Emitir </a></td>
                    <td><a class="btn btn-default" href="<?php echo base_url("leitores/alterar_leitor/".$tp->id_leitor) ?>"> Alterar </a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if(!empty($paginacao)){echo $paginacao;} ?>
</div>