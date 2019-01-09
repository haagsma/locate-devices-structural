<?php
/**
 * Created by PhpStorm.
 * User: Haagsma
 * Date: 25/07/2018
 * Time: 23:58
 */

include_once ("conexao.php");


$tipo = $_GET['tipo'];

if($tipo == "lat"){
    $placa_map = $_GET['placa'];
    $select_veiculo_map = $conn->query("SELECT * FROM tbl_cadastro_veiculo WHERE placa = '$placa_map'");
    $result_map_placa = mysqli_fetch_assoc($select_veiculo_map);
    $lat = $result_map_placa['latitude'];
    echo $lat;
}elseif ($tipo == "long"){
    $placa_map = $_GET['placa'];
    $select_veiculo_map = $conn->query("SELECT * FROM tbl_cadastro_veiculo WHERE placa = '$placa_map'");
    $result_map_placa = mysqli_fetch_assoc($select_veiculo_map);
    $long = $result_map_placa['longitude'];
    echo $long;
}


?>