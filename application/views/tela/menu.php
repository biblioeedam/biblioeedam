
﻿<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">cPainel</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Reportagem <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()."noticia/" ?>"> Ver Todas</a></li>
                        <li><a href="<?php echo base_url(); ?>noticia/nova"> Nova Noticia </a></li>
                        <li><a href="<?php echo base_url(); ?>noticia/alterar_noticia"> Alterar Noticia</a></li>
                        <li><a href="<?php echo base_url(); ?>noticia/ativar_desativar">Ativar/Desativar</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Secretaria <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>secretaria"> Ver Todas </a></li>
                        <li><a href="<?php echo base_url(); ?>secretaria/nova"> Nova Secretaria </a></li>
                        <li><a href="<?php echo base_url(); ?>secretaria/alterar_secretaria"> Alterar Secretaria</a></li>
                        <li><a href="<?php echo base_url(); ?>secretaria/ativar_desativar">Ativar/Desativar</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Mural <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>mural"> Ver Todas </a></li>
                        <li><a href="<?php echo base_url(); ?>mural/nova"> Novo Mural </a></li>
                        <li><a href="<?php echo base_url(); ?>mural/alterar_mural"> Alterar Mural</a></li>
                        <li><a href="<?php echo base_url(); ?>mural/ativar_desativar">Ativar/Desativar</a></li>

                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> <?php echo $this->session->userdata('nome_usuario'); ?> </a></li>
                <li><a href="<?php echo base_url() . "seguranca/logoutUser" ?>"> Sair </a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container">