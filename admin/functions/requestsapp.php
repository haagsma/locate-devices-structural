<?php
/**
 * Created by PhpStorm.
 * User: Haagsma
 * Date: 08/08/2018
 * Time: 16:40
 */

header('Access-Control-Allow-Origin: *');

session_start();



$baseUrl = "../views/";

include_once("conexao.php");

class Objeto{}


if(isset($_POST['funcao'])){
    $funcao = $_POST['funcao'];
    $funcao($conn);
}
if(isset($_GET['funcao'])){
    $funcao = $_GET['funcao'];
    $funcao($conn);
}

/**
 *
 */

function post($dado){
    if(isset($_POST["$dado"])){
        return $_POST["$dado"];
    }else{
        return "";
    }
}
function get($dado){
    if(isset($_GET["$dado"])){
        return $_GET["$dado"];
    }else{
        return "";
    }
}
function logar($conn){
    $email = $_POST['email'];
    $senha= sha1($_POST['senha']);

    $select_ficha_empresa = "SELECT * FROM cadastro_empresa WHERE email LIKE '$email'";
    $pegar_ficha_empresa = $conn->query($select_ficha_empresa);

    $select_ficha_motorista = "SELECT * FROM cadastro_motorista WHERE email LIKE '$email'";
    $pegar_ficha_motorista = $conn->query($select_ficha_motorista);

    if($pegar_ficha_empresa->num_rows > 0){
        while($row = $pegar_ficha_empresa->fetch_assoc()){
            $teste_senha = $row['senha'];

            if($senha == $teste_senha){
                echo "cliente&".$email;
            }else{
                echo "errou";
            }
        }
    }elseif ($pegar_ficha_motorista->num_rows > 0){
        while($row = $pegar_ficha_motorista->fetch_assoc()){
            $teste_senha = $row['senha'];

            if($senha == $teste_senha ){
                echo "motorista&".$email;
            }else{
                echo "errou";
            }
        }

    }else{
        echo "errou";
    }
}

function verificaCadastroMotorista($conn){
    $email = post('email');
    $request = $conn->query("SELECT * FROM cadastro_motorista WHERE email = '$email'");
    $request_veiculo = $conn->query("SELECT * FROM tbl_cadastro_veiculo WHERE proprietario_veiculo = '$email'");
    $result = $request->fetch_assoc();
    if($result['cpf'] == null OR $result['cpf'] == '' OR $result['celular'] == null){
        echo "pendente";
    }elseif(mysqli_num_rows($request_veiculo) < 1){
        echo "pendenteVeiculo";
    }else{
        echo "liberado";
    }
}
function verificaCadastroCliente($conn){
    $email = post('email');
    $request = $conn->query("SELECT * FROM cadastro_empresa WHERE email = '$email'");
    $result = $request->fetch_assoc();
    if($result['celular'] == null OR $result['celular'] == '' OR $result['telefone'] == null OR $result['telefone'] == ''){
        echo "pendente";
    }else{
        echo "liberado";
    }
}

function cadastrarMotorista($conn){

    $nome = $_POST['nome_completo'];
    $cnh = $_POST['cnh'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_c = $_POST['senha_confirmacao'];

    if($senha != $senha_c){
        echo "errou";
    } else {
        $senha_cript = sha1($senha);
        $inserir = "INSERT INTO cadastro_motorista (nome_completo, cnh, email, senha) VALUES ('$nome', '$cnh', '$email', '$senha_cript')";
        $realizar_insercao = mysqli_query($conn, $inserir);

        if(mysqli_insert_id($conn)){
            echo $email;
        } else {
            echo "errou";
        }
    }
}

function cadastrarCliente($conn){

    $razao = $_POST['razao'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_c = $_POST['senha_confirmacao'];

    if($senha != $senha_c){
        echo "errou";
    } else {
        $senha_cript = sha1($senha);
        $inserir = "INSERT INTO cadastro_empresa (razao_social, cnpj, email, senha) VALUES ('$razao', '$cnpj', '$email', '$senha_cript')";
        $realizar_insercao = mysqli_query($conn, $inserir);

        if(mysqli_insert_id($conn)){
            echo $email;
        } else {
            echo "errou";
        }
    }
}

function selectCampoMotorista($conn){

    $email = $_POST['email'];
    $campo = $_POST['campo'];

    $select = "SELECT $campo FROM cadastro_motorista WHERE email LIKE '$email'";
    $result = $conn->query($select);
    while($col = $result->fetch_assoc() ){
        echo $col[$campo];
    }

}

function selectCampoCliente($conn){

    $email = $_POST['email'];
    $campo = $_POST['campo'];

    $select = "SELECT $campo FROM cadastro_empresa WHERE email LIKE '$email'";
    $result = $conn->query($select);
    while($col = $result->fetch_assoc() ){
        echo $col[$campo];
    }

}

function atualizarCadastroMotorista($conn){

    $complemento = "";

    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $id = $_POST['id'];
    $path_icon = "../assets/images/avatar/user-".$id.".png";

    $cpf = $_POST['cpf'];
    $cnh = $_POST['cnh'];
    $inserir = "UPDATE cadastro_motorista SET cnh = '$cnh' ,imagem = '$path_icon', cpf = '$cpf', telefone = '$telefone', celular = '$celular', rua = '$rua', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep' WHERE `cadastro_motorista`.`email` = '$email'";
    $update_inserir = $conn->query($inserir);


}

function atualizarCadastroCliente($conn){

    $complemento = "";

    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $id = $_POST['id'];
    $path_icon = "../assets/images/avatar/user-empresa-".$id.".png";
    $representante = $_POST['representante'];

    $inserir = "UPDATE cadastro_empresa SET nome_repres = '$representante', imagem = '$path_icon', telefone = '$telefone', celular = '$celular', rua = '$rua', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep' WHERE `cadastro_empresa`.`email` = '$email'";
    $update_inserir = $conn->query($inserir);


}

function attAvatar($conn){

    $id = $_POST['id'];
    echo $id;
    //Inicio upload arquivo foto-icone
    $target_dir = "../assets/images/avatar/";
    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . basename("user-".$id.".png");
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        echo "Desculpe, o arquivo é muito grande, a imagem deve ter no máximo 1MB, tente novamente"; exit;
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        unlink($target_file);
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Desculpe, somente são aceitos arquivos PNG, JPG e JPEG, tente novamente"; exit;
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Desculpe, o arquivo não foi carregado, tente novamente."; exit;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Cadastro Atualizado!"; exit;
        } else {
            echo "Desculpe, o arquivo não foi carregado, tente novamente"; exit;
        }
    }
}

function attAvatarCliente($conn){

    $id = $_POST['id'];
    echo $id;
    //Inicio upload arquivo foto-icone
    $target_dir = "../assets/images/avatar/";
    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . basename("user-empresa-".$id.".png");
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        echo "Desculpe, o arquivo é muito grande, a imagem deve ter no máximo 1MB, tente novamente"; exit;
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        unlink($target_file);
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Desculpe, somente são aceitos arquivos PNG, JPG e JPEG, tente novamente"; exit;
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Desculpe, o arquivo não foi carregado, tente novamente."; exit;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Cadastro Atualizado!"; exit;
        } else {
            echo "Desculpe, o arquivo não foi carregado, tente novamente"; exit;
        }
    }
}

function telaAjuda($conn) {
    $query = "SELECT pergunta, resposta FROM tbl_faq WHERE id > 1";
    $result_query = $conn->query($query);
    while($col = $result_query->fetch_assoc()){
        $pergunta = $col['pergunta'];
        $resposta = $col['resposta'];  ?>
        <!-- <li class="treeview">
            <a class="break-word" href="#" >
                <span><?= $pergunta ?></span>
                </span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu respostas">
                <li class="break-word"><?= $resposta ?></li>
            </ul>
        </li>-->
        <div class="carga">
            <form >
                <div class="form-group quebrarlinha">
                    <div class="clearfix"></div>
                    <h3 class="title-carga" style="max-width: 250px"><?= $pergunta ?></h3>
                    <div style="max-width: 250px"><?= $resposta ?></div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
<?php
    }
}

function pesquisaCargaCidade($conn) {
    $dado = post('campo');
    $query = "SELECT id, cidade_origem, estado_origem, cidade_destino, estado_destino, valor, tipo_veiculo FROM tbl_frete WHERE status = 'Disponivel' AND ( cidade_destino LIKE '%$dado%' OR cidade_origem LIKE '%$dado%' ) ";
    $result_query = $conn->query($query);
    while($col = $result_query->fetch_assoc()){
        ?>
        <div class="carga">
            <form id="aceitarCargaDisponivel<?= $col['id'] ?>">
                <div class="form-group">
                    <div class="clearfix"></div>
                    <h3 class="title-carga"><?= $col['cidade_origem']." - ".$col['estado_origem']." a ".$col['cidade_destino']." - ".$col['estado_destino'] ?></h3>
                    Tipo veículo: <?= $col['tipo_veiculo'] ?><br>
                    Valor: R$ <?= $col['valor'] ?>
                    <input name="funcao" value="aceitarCarga" hidden>
                    <input name="idCarga" class="idCarga" value="<?= $col['id'] ?>" hidden>
                    <button class="aceitarCarga" type="button">Aceitar Carga</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php

    }
}

function pesquisaCargaEstado($conn) {
    $dado = post('campo');
    $query = "SELECT id, cidade_origem, estado_origem, cidade_destino, estado_destino, valor, tipo_veiculo FROM tbl_frete WHERE status = 'Disponivel' AND ( estado_destino LIKE '%$dado%' OR estado_origem LIKE '%$dado%' ) ";
    $result_query = $conn->query($query);
    echo "[";
    while($col = $result_query->fetch_assoc()){

        ?>
        <div class="carga">
            <form id="aceitarCargaDisponivel<?= $col['id'] ?>">
                <div class="form-group">
                    <div class="clearfix"></div>
                    <h3 class="title-carga"><?= $col['cidade_origem']." - ".$col['estado_origem']." a ".$col['cidade_destino']." - ".$col['estado_destino'] ?></h3>
                    Tipo veículo: <?= $col['tipo_veiculo'] ?><br>
                    Valor: R$ <?= $col['valor'] ?>
                    <input name="funcao" value="aceitarCarga" hidden>
                    <input name="idCarga" class="idCarga" value="<?= $col['id'] ?>" hidden>
                    <button class="aceitarCarga" type="button">Aceitar Carga</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php

    }
}
function pegaPlaca($conn){
    $email = post('email');
    $query = "SELECT placa FROM tbl_cadastro_veiculo WHERE proprietario_veiculo = '$email' LIMIT 1";
    $result_query = $conn->query($query);
    while($col = $result_query->fetch_assoc()){
        echo $col['placa'];
    }
}

function aceitarFrete ($conn){
    $id = post('id');

    $validar = $conn->query("SELECT * FROM tbl_frete WHERE id = '$id'");
    while($col = mysqli_fetch_assoc($validar)){
        $oi = $col['placa'];
    }
    if($oi === null or $oi == ""){
        $email = post('email');
        $placa = post('placa');
        if($placa === null or $placa == ""){
            echo "Não foi possível solicitar esse frete, cadastre um veículo!";
        }else{
            mysqli_query($conn, "UPDATE tbl_frete SET status = 'Aguardando aprovação', motorista = '$email', placa = '$placa' WHERE id = '$id'");
            echo "Frete solicitado com sucesso e enviado para aprovação!";
        }

    }else{
        echo "Não foi possível solicitar esse frete, talvez alguem já tenha solicitado, tente novamente ou escolha outro frete!";
    }
}

function telaCargaTransportadas($conn){
    $email = get('email');
    $query = "SELECT * FROM tbl_frete WHERE motorista = '$email' AND status = 'Concluido'";
    $result_query = $conn->query($query);
    while($col = mysqli_fetch_assoc($result_query)){
        ?>
        <div class="carga">
            <form >
                <div class="form-group">
                    <div class="clearfix"></div>
                    <h3 class="title-carga"><?= $col['cidade_origem']." - ".$col['estado_origem']." a ".$col['cidade_destino']." - ".$col['estado_destino'] ?></h3>
                    Tipo veículo: <?= $col['tipo_veiculo'] ?><br>
                    Valor: R$ <?= $col['valor'] ?>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php
    }
}

function telaCargaTransportadasCliente($conn){
    $email = get('email');
    $query = "SELECT * FROM tbl_frete WHERE empresa = '$email' AND status = 'Concluido'";
    $result_query = $conn->query($query);
    while($col = mysqli_fetch_assoc($result_query)){
        ?>
        <div class="carga">
            <form >
                <div class="form-group">
                    <div class="clearfix"></div>
                    <h3 class="title-carga"><?= $col['cidade_origem']." - ".$col['estado_origem']." a ".$col['cidade_destino']." - ".$col['estado_destino'] ?></h3>
                    Tipo veículo: <?= $col['tipo_veiculo'] ?><br>
                    Valor: R$ <?= $col['valor'] ?>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php
    }
}

function telaCargaTransportando($conn){
    $email = get('email');
    $query = "SELECT * FROM tbl_frete WHERE motorista = '$email' AND status = 'Transportando'";
    $result_query = $conn->query($query);
    while($col = mysqli_fetch_assoc($result_query)){
        ?>
        <div class="carga">
            <form>
                <div class="form-group">
                    <div class="clearfix"></div>
                    <h3 class="title-carga"><?= $col['cidade_origem']." - ".$col['estado_origem']." a ".$col['cidade_destino']." - ".$col['estado_destino'] ?></h3>
                    Origem: <?= $col['end_origem'] ?><br>
                    Destino: <?= $col['end_destino'] ?><br>
                    Tipo veículo: <?= $col['tipo_veiculo'] ?><br>
                    Valor: R$ <?= $col['valor'] ?>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php
    }
}
function telaAvisos($conn){
    $email = get('email');
    $query = "SELECT * FROM tbl_aviso WHERE destinatario = '$email' ORDER BY id DESC";
    $result_query = $conn->query($query);
    while($col = mysqli_fetch_assoc($result_query)){
        ?>
        <div class="carga">
            <form>
                <div class="form-group">
                    <div class="clearfix"></div>
                    <h3 class="title-carga"><?= $col['titulo_aviso'] ?></h3>
                    <?= $col['mensagem'] ?><br>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php
    }
}

function enviarMensagem($conn){
    $titulo = post('titulo');
    $mensagem = post('mensagem');
    $email = post('email');
    $data = date("Y-m-d");
    $query = "INSERT INTO `tbl_aviso` (`data`, `remetente`, `titulo_aviso`, `mensagem`) VALUES ('$data', '$email', '$titulo', '$mensagem')";
    $conn->query($query);
    echo "Mensagem enviada com sucesso!";

}

function enviarLocal($conn){
    $lat = post('lat');
    $long = post('long');
    $email = post('email');
    $query = "UPDATE `tbl_cadastro_veiculo` SET `latitude` = '$lat', `longitude` = '$long' WHERE `tbl_cadastro_veiculo`.`proprietario_veiculo` = '$email' ";
    $conn->query($query);
}

function cadastroVeiculo($conn){
    $tipo_veiculo = $rastreador = $placa_veiculo = $marca = $modelo = $ano_fab = $ano_model = $placa_cavalo = $placa_carreta = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $proprietario = $_POST['proprietario'];
    $tipo_veiculo = test_input($_POST['tipo_veiculo']);
    $rastreador = test_input($_POST['rastreador']);
    $placa_veiculo = test_input($_POST['placa_veiculo']);
    $marca = test_input($_POST['marca']);
    $renavam = test_input($_POST['renavam']);
    $modelo = test_input($_POST['modelo']);
    $ano_fab = test_input($_POST['ano_fab']);
    $ano_model = test_input($_POST['ano_model']);
    $placa_carreta = test_input($_POST['placa_carreta']);

    $inserir = "INSERT INTO tbl_cadastro_veiculo (renavam, proprietario_veiculo, placa, marca, modelo, ano_fab, ano_model, tipo_veiculo, placa_carreta, rastreador) VALUES ('$renavam' ,'$proprietario', '$placa_veiculo', '$marca', '$modelo', '$ano_fab', '$ano_model', '$tipo_veiculo', '$placa_carreta', '$rastreador') ";
    mysqli_query($conn, $inserir);

    if(mysqli_insert_id($conn)){
        echo "Veiculo cadastrado com sucesso";
    }else{
        echo "Veiculo não foi cadastrado, você pode cadastrar somente 1 veículo";
    }
}

function termosUso ($conn){
    $query = $conn->query("SELECT * FROM tbl_termos_de_uso");
    $result = $query->fetch_assoc();
    echo $result['mensagem_corpo'];
}
function telaMsg ($conn){
    $email = get('email');
    $query = $conn->query("SELECT * FROM tbl_aviso WHERE remetente = '$email' ORDER BY id DESC");
    while($col = mysqli_fetch_assoc($query)){
        $temp = $col['hora_criacao'];
        $date2 = date_create($temp);
        $date3 = date_format($date2, 'd-m-Y h:i:s');
        ?>
        <div class="carga">
            <form>
                <div class="form-group">
                    <div class="clearfix"></div>
                    <h3 class="title-carga"><?= $col['titulo_aviso'] ?></h3>
                    <?= $col['mensagem'] ?><br>
                    <small><?= $date3 ?></small><br>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php
    }
}
function pegaPush($conn){
    class myObj {}

    $array = array();
    $email = get('email');
    $query_placa = $conn->query("SELECT placa FROM tbl_cadastro_veiculo WHERE proprietario_veiculo = '$email'");
    $result_placa = $query_placa->fetch_assoc();
    $placa = $result_placa['placa'];
    $query_push = $conn->query("SELECT * FROM tbl_push WHERE placa = '$placa'");
    if($query_push->num_rows > 0){
        while ($col = $query_push->fetch_assoc()){
            $myObj = new myObj();
            $myObj->titulo = $col['titulo'];
            $myObj->mensagem = $col['mensagem'];
            $myObj->placa = $col['placa'];
            array_push($array, $myObj);
        }
        $conn->query("DELETE FROM tbl_push WHERE placa = '$placa'");
        $myJSON = json_encode($array);
        echo $myJSON;
    }
}

?>