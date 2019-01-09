<?php
/**
 * Created by PhpStorm.
 * User: Haagsma
 * Date: 10/10/2018
 * Time: 13:16
 */

header('Access-Control-Allow-Origin: *');

include_once ("conexao.php");

class Objeto{}

$json = file_get_contents('php://input');
$obj = json_decode($json);