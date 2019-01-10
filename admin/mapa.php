<?php
session_start();

include_once ("functions/conexao.php");
require("functions/icon_user.php");
require("functions/alerta_avisos.php");
require("functions/auth_admin.php");



$placas = $conn->query("SELECT * FROM tbl_cadastro_veiculo");


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="assets/images/fav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="Sistema de Gestão de Hosting" name="description"/>
    <meta content="WebLO" name="http://weblo.com.br"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/fav.png">

    <!-- Jquery filer css -->
    <link href="plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet"/>
    <link href="plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet"/>

    <!-- Bootstrap fileupload css -->
    <link href="../admin/plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet"/>

    <!-- Plugins css-->
    <link href="plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet"/>
    <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../admin/plugins/switchery/switchery.min.css">

    <!-- App css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/map.css" rel="stylesheet" type="text/css"/>

    <script src="assets/js/modernizr.min.js"></script>


</head>


<body>

<!-- Begin page -->
<div id="wrapper">

    <?php require_once ("layout/nav.php") ?>


    <!-- ============================================================== -->
    <!-- Start right Content here  -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Mapa de Localização</h4>
                            <select class="selectpicker col-md-2 text-uppercase" id="placaAlone" data-live-search="true" style="margin-left: 20px">
                                <?php
                                while($col = $placas->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $col['latitude']."&".$col['longitude']."&".$col['placa'] ?>" data-tokens="ketchup mustard" class="text-uppercase"><?= $col['placa'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>

                            <button  type="button" class="btn btn-info" id="btnAlone" style="margin-left: 10px">Localizar</button>
                            <ol class="breadcrumb p-0 m-0">
                                <form class="form-inline" role="form" method="get" action="#">
                                    <div class="form-group">
                                        <button  type="button" class="btn btn-danger col-md-2" data-toggle="modal" data-target="#enviarFrete" style="margin-right: 10px">Enviar frete</button>
                                        <input type="text" id="raio" class="form-control col-md-2" placeholder="Distancia em Km" value="30">
                                        <input id="address" class="form-control" type="textbox" value="São Paulo">
                                        <input class="btn btn-primary" id="submit" type="button" value="Pesquisar">
                                    </div>
                                    <!--<div class="form-group" >
                                        <label class="sr-only">Placa</label>
                                        <select id="placaGMap" class="selectpicker text-uppercase" data-live-search="true" data-style="btn-default" style="overflow: auto" name="placa" >
                                            <option class="text-uppercase" title="--- Buscar pela Placa ---">--- Buscar pela Placa ---</option>

                                        </select>
                                    </div>

                                    <button type="button" onclick="acharPlaca();" class="btn btn-primary waves-effect waves-light m-l-10 btn-md" name="submit">Buscar</button>-->
                                </form>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->


            <div id="map"></div>
            <div id="right-panel">
                <h2>Placas</h2>
                <ul id="places" class="text-uppercase"></ul>
                <button id="more" hidden>More results</button>
            </div>
            <div id="coords" hidden></div>
            <!--<div id="map" class="embed-responsive-item" ></div>
            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.06583011897!2d-46.65298398543181!3d-23.56607906765072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c8da0aa315%3A0xd59f9431f2c9776a!2sAv.+Paulista+-+Bela+Vista%2C+S%C3%A3o+Paulo+-+SP!5e0!3m2!1spt-BR!2sbr!4v1527449390430" width="100%" height="480" frameborder="0" style="border:0" allowfullscreen></iframe>-->

        </div> <!-- content -->
        <!-- Modal -->
        <div class="modal fade" id="enviarFrete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enviar Frete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEnviarFreteMaps" action="" method="post">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control tituloEnvia" placeholder="Digite o título" required>
                            </div>
                            <div class="form-group">
                                <label>Mensagem</label>
                                <textarea class="form-control mensagemEnvia" placeholder="Digite a mensagem" maxlength="255" required></textarea>
                                <small>Até 255 caracteres</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Fechar</button>
                        <button type="button" id="btnEnviarFreteMaps" class="btn btn-danger btn-rounded">Enviar Frete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->


<script>
    var resizefunc = [];
</script>



<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="plugins/switchery/switchery.min.js"></script>
<script src="plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>
<script src="assets/js/maps.api.init.js"></script>
<script src="assets/js/custom.js"></script>



<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4KiYD6Z1n_xFT8QsIojgC7d2c1TDRrMM&callback=initMap">
</script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiQrhOraOdq8UmPCTxvmFbKNSEuoQCX90&libraries=places&callback=initMap" async defer></script>

<script type="text/javascript">
</script>


</body>

</html>
