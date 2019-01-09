<?php
session_start();

require("functions/auth_admin.php");
include_once ("functions/conexao.php");
	require("functions/icon_user.php");
	require("functions/alerta_avisos.php");

$result_tab = $conn->query("SELECT * FROM tbl_cadastro_admin");
$result_empresa345 = $conn->query("SELECT razao_social, email FROM cadastro_empresa");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>99Cargas - Sistema de Gestão</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="Sistema de Gestão 99Cargas" name="description"/>
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

    <!-- DataTables -->
    <link href="../site/vendor/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="../site/vendor/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../site/vendor/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../site/vendor/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../site/vendor/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../site/vendor/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="../site/vendor/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../site/vendor/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!-- App css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>

    <script src="assets/js/modernizr.min.js"></script>


    <!-- datepicker -->
    <link href="assets/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <!-- AngularJs -->
    <script src="assets/js/angular.min.js"></script>
    <script type="text/javascript">
        angular.module('Pagina', [])
            .controller('Menu', function($rootScope, $scope, $http){

                $scope.exibirForm1 = true;
                $scope.exibirForm2 = false;

                $scope.exibirForms = function (value) {

                    if(value == 1 ){
                        $scope.exibirForm1 = true;
                        $scope.exibirForm2 = false;

                    }else{
                        $scope.exibirForm1 = false;
                        $scope.exibirForm2 = true;

                    }

                }



            });
    </script>

</head>


<body ng-app="Pagina" >

<!-- Begin page -->
<div id="wrapper">

    <?php require_once ("layout/nav.php") ?>


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page" ng-controller="Menu">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <!--<button type="button" class="btn btn-primary btn-lg" ng-click="exibirForms(1)">Orçamento Cargas</button>
                            <button type="button" class="btn btn-primary btn-lg" ng-click="exibirForms(2)">Cadastrar Cargas</button>-->
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>
                                    <a href="#">APP</a>
                                </li>
                                <li class="active">
                                    Cadastrar Cargas
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <!-- Inicio do Cadastro de frete -->
                <div class="row" ng-show="exibirForm1">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Cadastrar Cargas</b></h4>
                            <form class="form-horizontal" role="form" method="post" action="functions/cadastro_cargas.php" >
                                <div class="row">
                                    <?php
                                    if(isset($_SESSION['session_99cargas_imagem_falha'])){ ?>
                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <?= $_SESSION['session_99cargas_imagem_falha']; unset($_SESSION['session_99cargas_imagem_falha']); ?>
                                        </div>
                                    <?php  } elseif (isset($_SESSION['session_99cargas_imagem_sucesso'])){ ?>
                                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <?= $_SESSION['session_99cargas_imagem_sucesso']; unset($_SESSION['session_99cargas_imagem_sucesso']); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Empresa:</label>
                                            <div class="col-md-9">
                                                <select name="email" class="selectpicker" data-live-search="true">
                                                    <?php
                                                    while ($col = $result_empresa345->fetch_array()) {
                                                        ?>
                                                        <option value="<?= $col['email'] ?>" data-tokens="<?= $col['email']."".$col['razao_social'] ?>"><?= $col['razao_social'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <!--<input type="email" class="form-control" name="email" placeholder="Email do Cliente"
                                                       required>-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">CEP origem</label>
                                            <div class="col-md-9">
                                                <input type="text" name="cep_origem" class="form-control cep-origem" placeholder="Cep de origem" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Cidade de origem</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control cidade-origem" name="cidade_origem" placeholder="Estado de origem" required>
                                            </div>
                                            <label class="col-md-2 control-label">UF</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control estado-origem" name="estado_origem" placeholder="UF" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Bairro de origem</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control bairro-origem" name="bairro_origem" placeholder="Bairro de origem"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Endereço de origem</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control endereco-origem" name="end_origem" placeholder="Endereço de origem"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Numero de origem</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="numero_origem" placeholder="Numero" maxlength="5" required>
                                            </div>
                                            <label class="col-md-2 control-label">Complemento</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="complemento_origem" placeholder="Complemento" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">CEP destino</label>
                                            <div class="col-md-9">
                                                <input type="text" name="cep_destino" class="form-control cep_destino" placeholder="Cep de destino" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Cidade de destino</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control cidade_destino" name="cidade_destino" placeholder="Estado de destino" required>
                                            </div>
                                            <label class="col-md-2 control-label">UF</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control estado_destino" name="estado_destino" placeholder="UF" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Bairro de destino</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control bairro_destino" name="bairro_destino" placeholder="Bairro de destino"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Endereço de destino</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control endereco_destino" name="end_destino" placeholder="Endereço de destino"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Numero de destino</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="numero_destino" placeholder="Numero" maxlength="5" required>
                                            </div>
                                            <label class="col-md-2 control-label">Complemento</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="complemento_destino" placeholder="Complemento">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Data inicial</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control datepicker" name="data_inicial" placeholder="Data inicial"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Data Entrega</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control datepicker" name="data_entrega" placeholder="Data de entrega"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Produto</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="tipo_produto" placeholder="Produto" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Rastreador</label>
                                            <div class="col-md-4">
                                                <select name="rastreador" class="form-control">
                                                    <option>Rastreador</option>
                                                    <option value="sim">Sim</option>
                                                    <option value="nao">Não</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Peso real</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="peso_real" placeholder="Peso real"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Peso Cubado</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="peso_cubado" placeholder="Peso Cubado"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label class="col-md-3 control-label">Veículos</label><br>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Rodotrem"> Rodotrem (< 40t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Bitrem"> Bitrem (< 35t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Carreta LS"> Carreta LS (< 27t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Carreta"> Carreta (< 25t)<br>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Bitruck"> Bitruck (< 22t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Truck"> Truck (< 15t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Toco"> Toco (< 8t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="3/4"> 3/4 (< 4t)<br>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="tipo_veiculo[]" value="VUC"> VUC (< 3.9t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="HR"> HR (< 1.5t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Van"> Van (< 1.8t)<br>
                                                        <input type="checkbox" name="tipo_veiculo[]" value="Utilitario"> Utilitario (< 0.65t)<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="col-md-3 control-label">Carroceria</label><br>
                                                        <div class="col-md-3">
                                                            <input type="checkbox" name="carroceria[]" value="Baú"> Baú<br>
                                                            <input type="checkbox" name="carroceria[]" value="Baú Frigorifico"> Baú Frigorifico<br>
                                                            <input type="checkbox" name="carroceria[]" value="Boiadeiro"> Boiadeiro<br>
                                                            <input type="checkbox" name="carroceria[]" value="Caçamba"> Caçamba<br>
                                                            <input type="checkbox" name="carroceria[]" value="Container"> Container<br>
                                                            <input type="checkbox" name="carroceria[]" value="Gaiola"> Gaiola<br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="checkbox" name="carroceria[]" value="Grade Baixa"> Grade Baixa<br>
                                                            <input type="checkbox" name="carroceria[]" value="Graneleiro"> Graneleiro<br>
                                                            <input type="checkbox" name="carroceria[]" value="Munk"> Munk<br>
                                                            <input type="checkbox" name="carroceria[]" value="Prancha"> Prancha<br>
                                                            <input type="checkbox" name="carroceria[]" value="Sider"> Sider<br>
                                                            <input type="checkbox" name="carroceria[]" value="Silo"> Silo<br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="checkbox" name="carroceria[]" value="Tanque"> Tanque<br>
                                                            <input type="checkbox" name="carroceria[]" value="Só Cavalo Mecânico"> Só Cavalo Mecânico<br>
                                                            <label class="control-label">Carroceria(s) para Leves</label><br>
                                                            <input type="checkbox" name="carroceria[]" value="Aberta"> Aberta<br>
                                                            <input type="checkbox" name="carroceria[]" value="Fechada"> Fechada<br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Valor do frete</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="valor" placeholder="Coloque 0 para A Combinar"
                                                       required>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="checkbox" name="tipo_pagamento[]" value="Por Tonelada" checked> Por Tonelada
                                                <input type="checkbox" name="tipo_pagamento[]" value="A combinar"> A combinar <br>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Pedagio</label>
                                            <div class="col-md-4">
                                                <input type="radio" name="pedagio" value="incluso" checked> Pedágio incluso
                                                <input type="radio" name="pedagio" value="a parte"> Pedágio a parte
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Observações</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="observacao" placeholder="Opcional"></textarea>
                                                <small> até 250 caracteres</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Quantidade de entregas</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="quantidade_entrega" placeholder="Quantidade de entregas" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tipo de Carga</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="tipo_carga" placeholder="Tipo de Carga" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="hidden" name="tipo_cadastro" value="carga" >
                                        <button type="submit" name="submit" class="btn btn-lg btn-info waves-effect waves-light">
                                            <i class="fi fi-plus"></i> Cadastrar Carga</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- Fim do  Cadastro de frete -->



            </div> <!-- container -->
        </div> <!-- content -->

        <footer class="footer text-right">
            Copyright 2017 © WebLO.
        </footer>

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
<script src="assets/js/jquery.api.correios.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

<script src="plugins/switchery/switchery.min.js"></script>
<script src="plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

<script type="text/javascript" src="../admin/plugins/autocomplete/jquery.mockjax.js"></script>
<script type="text/javascript" src="../admin/plugins/autocomplete/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="../admin/plugins/autocomplete/countries.js"></script>

<!-- Jquery filer js -->
<script src="plugins/jquery.filer/js/jquery.filer.min.js"></script>

<!-- Bootstrap fileupload js -->
<script src="plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>

<!-- Init Js file -->
<script type="text/javascript" src="../admin/assets/pages/jquery.form-advanced.init.js"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- data mask -->
<script src="plugins/datamask/jquery.mask.js" type="text/javascript"></script>


<script src="../site/vendor/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../site/vendor/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="../site/vendor/plugins/datatables/jszip.min.js"></script>
<script src="../site/vendor/plugins/datatables/pdfmake.min.js"></script>
<script src="../site/vendor/plugins/datatables/vfs_fonts.js"></script>
<script src="../site/vendor/plugins/datatables/buttons.php5.min.js"></script>
<script src="../site/vendor/plugins/datatables/buttons.print.min.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../site/vendor/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.colVis.js"></script>
<script src="../site/vendor/plugins/datatables/dataTables.fixedColumns.min.js"></script>

<!-- datepicker -->
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        startDate: '+0d',
    });
</script>

<!-- init -->
<script src="../site/vendor/assets/pages/jquery.datatables.init.js"></script>


<!-- Modal-Effecsite/t -->
<script src="../site/vendor/plugins/custombox/js/custombox.min.js"></script>
<script src="../site/vendor/plugins/custombox/js/legacy.min.js"></script>

<!-- App js -->
<script src="../site/vendor/assets/js/jquery.core.js"></script>
<script src="../site/vendor/assets/js/jquery.app.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "../vendor/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();
</script>

</body>

</html>