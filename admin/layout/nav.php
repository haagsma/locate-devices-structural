<?php
/**
 * Created by PhpStorm.
 * User: Haagsma
 * Date: 05/09/2018
 * Time: 11:43
 */

?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <!--<a href="index.php" class="logo"><span>Code<span>Fox</span></span><i class="mdi mdi-layers"></i></a>-->
        <!-- Image logo -->
        <a href="index.php" class="logo">
                        <span>
                            <img src="assets/images/logo.png" alt="" height="40">
                        </span>
            <i>
                <img src="assets/images/logo_sm.png" alt="" height="40">
            </i>
        </a>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">

            <!-- Navbar-left -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <button type="button" class="button-menu-mobile open-left waves-effect">
                        <i class="dripicons-menu"></i>
                    </button>
                </li>

            </ul>
            <!-- Navbar-left -->

            <!-- Right(Notification) -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                        <i class="dripicons-bell"></i>
                        <span class="badge badge-pink"><?= $alert_total ?></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right dropdown-lg user-list notify-list">
                        <li class="list-group notification-list m-b-0">
                            <div class="slimscroll">
                                <?php if($alert_clientes > 0){ ?>
                                    <!-- list item-->
                                    <a href="99-app-rel-clientes.php" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-user-circle-o bg-success"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Novo Cliente Cadastrado!</h5>
                                                <p class="m-0">
                                                    Temos
                                                    <span class="text-success font-600"><?= $alert_clientes ?></span>
                                                    novos clientes cadastrados.
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                                <?php if($alert_motorista > 0){ ?>
                                    <!-- list item-->
                                    <a href="99-app-rel-motoristas.php" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="mdi mdi-account-location bg-info"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Novo Motorista cadastrado!</h5>
                                                <p class="m-0">
                                                    Temos
                                                    <span class="text-info font-600"><?= $alert_motorista ?></span>
                                                    novos motoristas cadastrados
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>


                                <?php if($alert_aviso > 0){ ?>
                                    <!-- list item-->
                                    <a href="99-app-rel-avisos.php" class="list-group-item">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <em class="fa fa-bell-o bg-warning"></em>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Avisos</h5>
                                                <p class="m-0">
                                                    Você tem <span class="text-warning font-600"><?= $alert_aviso; ?></span> avisos novos!
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </li>
                        <!-- end notification list -->
                    </ul>
                </li>

                <!-- Icone de Perfil -->
                <li class="dropdown user-box">
                    <a href="#" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown"
                       aria-expanded="true">
                        <img src="<?= $icon_user['imagem']; ?>" alt="user-img" class="img-circle user-img">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                        <li><a href="99-app-admin.php"><i class="fi-head"></i> Perfil</a></li>
                        <li class="divider"></li>
                        <li><a href="99-logout.php"><i class="fi-esc"></i> Sair</a></li>
                    </ul>
                </li>
                <!-- Icone de Perfil -->

            </ul><!-- end navbar-right -->
            <!-- Right(Notification) -->

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metisMenu nav" id="side-menu">

                <li>
                    <a href="index.php"><i class="fi-air-play"></i> <span> Dashboard </span> </a>
                </li>
                <li>
                    <a href="99-mapa.php"><i class="fi-map"></i> <span> Mapa </span> </a>
                </li>
                <li>
                    <a href="99-atendimento.php"><i class="fi-shuffle"></i> <span> Atendimento </span> </a>
                </li>

                <li class="menu-title">Gestão do APP (Sistema)</li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="fi-briefcase"></i>
                        <span> Cargas </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="99-app-cargas.php">Cadastrar Carga</a></li>
                        <!--<li><a href="99-orcamentos.php">Relação de Orçamentos</a></li>-->
                        <li><a href="99-app-rel-cargas-aprovacao.php">Cargas para aprovar</a></li>
                        <li><a href="99-app-rel-cargas-aguardando.php">Cargas Aguardando</a></li>
                        <li><a href="99-app-rel-cargas-tranportadas.php">Cargas Transportadas</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="fi-head"></i><span> Motoristas </span>
                        <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <!--<li><a href="99-app-motoristas.html">Cadastrar</a></li>-->
                        <li><a href="99-app-rel-motoristas.php">Relação de Motoristas</a></li>
                        <li><a href="99-app-rel-veiculos.php">Relação de Veiculos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="99-app-rel-clientes.php" ><i class="fi-head"></i><span> Clientes </span>
                        </a>
                </li>
                <li>
                    <a href="99-app-rel-avisos.php" ><i class="fi-bell"></i><span> Avisos </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="fi-paper"></i>
                        <span> Relatórios </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="99-app-rel-acessos-site.php">Acessos ao Site</a></li>
                        <li><a href="99-app-rel-acesso-app.php">Acessos ao APP</a></li>
                        <!--<li><a href="99-app-rel-cargas-transito.php">Cargas em Transito</a></li>-->
                        <li><a href="99-app-rel-newsletter.php">Newsletter</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="fi-cog"></i>
                        <span> Configurações </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="99-app-admin.php">Administrador</a></li>
                        <!--<li><a href="99-app-midia-social.php">Midia Social</a></li>-->
                    </ul>
                </li>

                <li class="menu-title">Gestão do Site</li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="fi-globe"></i>
                        <span> Página Inicial </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="99-site-slideshow.php">SlideShow</a></li>
                        <li><a href="99-site-secao01.php">Seção 01</a></li>
                        <li><a href="99-site-secao02.php">Seção 02</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="fi-paper-stack"></i> <span> Páginas Fixas </span>
                        <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="99-site-quem-somos.php">Quem Somos</a></li>
                        <li><a href="99-site-faq.php">F.A.Q</a></li>
                        <li><a href="99-site-servicos.php">Serviços</a></li>
                        <li><a href="99-site-contato.php">Contato</a></li>
                        <li><a href="99-site-termos.php">Termos de Uso</a></li>
                        <li><a href="99-site-politica.php">Politica de Privacidade</a></li>
                    </ul>
                </li>

                <li><a href="99-site-rodape.php"><i class="fi-book"></i> <span>Rodapé</span> </a></li>

                <li class="menu-title">Logout</li>

                <li><a href="99-logout.php"><i class="fi-esc"></i> <span>Sair</span> </a></li>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
