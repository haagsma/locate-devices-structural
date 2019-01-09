$(document).ready(function () {

    var baseUrlRequest = "https://99cargas.com/site/functions/requestsapp.php";

    $('#esqueciSenha').on('click', function (event) {
        event.preventDefault();
       $(location).attr('href', 'https://99cargas.com/site/recuperar-conta.html');
    });

    // Ajax logar
    $("#btnLogar").on('click', function (event) {
        event.preventDefault();
       var dados = $("#formLogar").serialize();
       $.post(baseUrlRequest, dados, function (data) {
           if(data != "errou"){
               let tipo = data.split('&');
               if(tipo[0] == 'cliente'){
                   document.cookie = "99useremail=" + tipo[1];
                   $(location).attr("href", "cliente/template.html");
               }else{
                   document.cookie = "99useremail=" + tipo[1];
                   $(location).attr("href", "motorista/template.html");
               }
           }else{
               alert("Usuário ou Senha errada!");
           }
       });
    });


    // Cadastrar usuários
    $(".btnCriarContaCliente").on('click', function (event) {
        event.preventDefault();
        var dados = $("#formCadastrarCliente").serialize();
        $.post(baseUrlRequest, dados, function (data) {
            if(data == "errou"){
                alert("Falha no cadastro, tente novamente!");
            }else{
                document.cookie = "99useremail=" + data;
                alert("Cadastro realizado com sucesso!");
                $(location).attr("href", "template.html");
            }
        });
    });
    $(".btnCriarContaMotorista").on('click', function (event) {
        event.preventDefault();
        var dados = $("#formCadastrarMotorista").serialize();
        $.post(baseUrlRequest, dados, function (data) {
            if(data == "errou"){
                alert("Falha no cadastro, tente novamente!");
            }else{
                document.cookie = "99useremail=" + data;
                alert("Cadastro realizado com sucesso!");
                $(location).attr("href", "template.html");
            }
        });
    });


});