<?php
/**
 * Created by PhpStorm.
 * User: Haagsma
 * Date: 11/09/2018
 * Time: 13:46
 */


include_once ("conexao.php");

$titulo = $_GET['titulo'];
$mensagem = $_GET['mensagem'];
$placa = $_GET['placa'];

$conn->query("INSERT INTO tbl_push (titulo, mensagem, placa) VALUES ('$titulo', '$mensagem', '$placa')");

if(mysqli_insert_id($conn)){
    echo "sucesso";
}else {
    echo "error";
}
$query = $conn->query("SELECT proprietario_veiculo FROM tbl_cadastro_veiculo WHERE placa = '$placa'")->fetch_assoc();
$motoristra = $query['proprietario_veiculo'];
$data = date("Y-m-d");
$conn->query("INSERT INTO `tbl_aviso` (`data`, `remetente`, `destinatario`, `titulo_aviso`, `mensagem`) VALUES ('$data', '99 Cargas', '$motoristra', '$titulo', '$mensagem')");