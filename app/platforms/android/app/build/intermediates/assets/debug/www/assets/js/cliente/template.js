$(document).ready(function () {

    var baseUrlRequest = "http://99cargas.com/site/functions/requestsapp.php";
    var userEmail = getCookie("99useremail");
    verificaCadastroCliente(userEmail);

    //Menu lateral
    selectCampoCliente(userEmail, "razao_social", "#userNome");

    $('.targetPage').click(function(){
        var target = $(this).attr('dt-page');
        $('.esconde').removeClass('pagina-ativa');
        $(target).addClass('pagina-ativa');
    });

    //TelaCadastro
    $("#emailCadastro").val(userEmail);
    selectCampoClienteCadastro(userEmail, "razao_social", "#nomeCadastro");
    selectCampoClienteCadastro(userEmail, "cnpj", "#cnpjCadastro");
    selectCampoClienteCadastro(userEmail, "nome_repres", "#repreCadastro");
    selectCampoClienteCadastro(userEmail, "telefone", "#telefoneCadastro");
    selectCampoClienteCadastro(userEmail, "celular", "#celCadastro");
    selectCampoClienteCadastro(userEmail, "cep", ".cepCadastro");
    selectCampoClienteCadastro(userEmail, "rua", ".endCadastro");
    selectCampoClienteCadastro(userEmail, "numero", ".numCadastro");
    selectCampoClienteCadastro(userEmail, "complemento", ".compCadastr");
    selectCampoClienteCadastro(userEmail, "bairro", ".baiCadastro");
    selectCampoClienteCadastro(userEmail, "cidade", ".cidCadastro");
    selectCampoClienteCadastro(userEmail, "estado", ".estCadastro");
    selectCampoClienteCadastro(userEmail, "id", "#idCadastro");
    selectImgCliente(userEmail, "id", ".imgPerfilCadastro");

    //Tela Ajuda
    telaAjuda();

    //Tela Cargas Transportadas
    telaCargaTransportadas();

    //Tela Avisos
    telaAvisos();

    //Tela termos
    termosUso();

    //Tela Msg
    telaMsg();


    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function verificaCadastroCliente(email) {
        dados2 = {
            funcao: "verificaCadastroCliente",
            email: email
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            if(data == 'pendente'){
                $('.esconde').removeClass('pagina-ativa');
                $('#pageCadastro').addClass('pagina-ativa');
            }
        });
    }
    function selectCampoCliente(email, campo, id) {
        dados2 = {
            funcao: "selectCampoCliente",
            email: email,
            campo: campo
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            $(id).html(data);
        });
    }
    function selectImgCliente(email, campo, id) {
        dados2 = {
            funcao: "selectCampoCliente",
            email: email,
            campo: campo
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            $(id).attr('src', "http://99cargas.com/site/assets/images/avatar/user-empresa-" + data + ".png");
        });
    }
    function selectCampoClienteCadastro(email, campo, id) {
        dados2 = {
            funcao: "selectCampoCliente",
            email: email,
            campo: campo
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            $(id).val(data);
        });
    }

    function telaAjuda(){
        $.get(baseUrlRequest + "?funcao=telaAjuda", function (data) {
            $(".telaPerguntas").html(data);
        });
    }

    function telaCargaTransportadas(){

        var dados = {
            funcao: "telaCargaTransportadasCliente",
            email: userEmail
        };
        let envia = $.param(dados);

        $.get(baseUrlRequest + "?" + envia, function (data) {
            $('#resultadoCargasTransportadas').html(data);
        });
    }
    function termosUso() {
        var dados = {
            funcao: "termosUso"
        };
        let envia = $.param(dados);

        $.get(baseUrlRequest + "?" + envia, function (data) {
            $('.termosUso').html(data);
        });
    }
    function telaAvisos(){

        var dados = {
            funcao: "telaAvisos",
            email: userEmail
        };
        let envia = $.param(dados);

        $.get(baseUrlRequest + "?" + envia, function (data) {
            $('#telaAvisos').html(data);
        });
    }
    $('#enviarImgUser').on('click', function () {



        var name = document.getElementById("fileToUpload").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
        {
            alert("Imagem invalida");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("fileToUpload").files[0]);
        var f = document.getElementById("fileToUpload").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000)
        {
            alert("A imagem é muito grande, tente outra!");
        }
        else
        {
            alert("Aguarde enquanto enviamos sua imagem");
            let id = $('#idCadastro').val();
            form_data.append("fileToUpload", document.getElementById('fileToUpload').files[0]);
            form_data.append("id", id);
            form_data.append("funcao", 'attAvatarCliente');
            form_data.append("submit", 'any');
            $.ajax({
                url: baseUrlRequest,
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                },
                success:function(data)
                {

                    alert("enviado");
                    $(location).attr("href", "template.html");
                }
            });
        }
    });
    function telaMsg(){
        var dados = {
            funcao: "telaMsg",
            email: userEmail
        };
        let envia = $.param(dados);

        $.get(baseUrlRequest + "?" + envia, function (data) {
            $('#telaMsg').html(data);
        });
    }

    $('#atualizaCadastro').on('click', function (event) {
        event.preventDefault();
        let formId = $(this).parent();
        let envia = formId.serialize();
        $.post(baseUrlRequest, envia, function (data) {
            alert("Cadastro Atualizado!");
        });

    });


    $('#btnEnviarMsg').on('click', function (event) {
        event.preventDefault();
       let form = $('#formEnviarMsg').serialize();
       let Oemail = {
         email: userEmail
       };
       let envia = form + "&" + $.param(Oemail);
       $.post(baseUrlRequest, envia, function (data) {
           $(location).attr('href', 'template.html');
       });
    });

    $('.sairApp').on('click', function (event) {
        event.preventDefault();
        $(location).attr("href", "../template.html");
    });
    $('.cnpj').change(function () {
        let campo = $('.cnpj').val();
        $('.cnpj').val(campo.slice(0,2)+"."+campo.slice(2,5)+"."+campo.slice(5,8)+"/"+campo.slice(8,12)+"-"+campo.slice(12,14));
    });


});

