$(document).ready(function () {


    var baseUrlRequest = "https://99cargas.com/site/functions/requestsapp.php";
    var userEmail = getCookie("99useremail");
    verificaCadastroMotorista(userEmail);

    //Menu lateral
    selectCampoMotorista(userEmail, "nome_completo", "#userNome");
    selectCampoMotorista(userEmail, "celular", "#userCelular");
    enviarLocal();
    setInterval(pushAlert, 10000);

    $('.targetPage').click(function(){
        var target = $(this).attr('dt-page');
        $('.esconde').removeClass('pagina-ativa');
        $(target).addClass('pagina-ativa');
    });

    $(".emailCadastro").val(userEmail);

    //TelaCadastro
    $("#emailCadastro").val(userEmail);
    selectCampoMotoristaCadastro(userEmail, "nome_completo", "#nomeCadastro");
    selectCampoMotoristaCadastro(userEmail, "cnh", "#cnhCadastro");
    selectCampoMotoristaCadastro(userEmail, "cpf", "#cpfCadastro");
    selectCampoMotoristaCadastro(userEmail, "telefone", "#telefoneCadastro");
    selectCampoMotoristaCadastro(userEmail, "celular", "#celCadastro");
    selectCampoMotoristaCadastro(userEmail, "cep", ".cepCadastro");
    selectCampoMotoristaCadastro(userEmail, "rua", ".endCadastro");
    selectCampoMotoristaCadastro(userEmail, "numero", ".numCadastro");
    selectCampoMotoristaCadastro(userEmail, "complemento", ".compCadastr");
    selectCampoMotoristaCadastro(userEmail, "bairro", ".baiCadastro");
    selectCampoMotoristaCadastro(userEmail, "cidade", ".cidCadastro");
    selectCampoMotoristaCadastro(userEmail, "estado", ".estCadastro");
    selectCampoMotoristaCadastro(userEmail, "id", "#idCadastro");
    selectImgMotorista(userEmail, "id", ".imgPerfilCadastro");

    //Tela Ajuda
    telaAjuda();

    //Tela Cargas Transportadas
    telaCargaTransportadas();

    //Tela Cargas Transportando
    telaCargaTransportando();

    //Tela Avisos
    setInterval(telaAvisos, 10000);

    //Tela termos
    termosUso();

    //Tela Msg
    telaMsg();

    //Tela Clube Vantagens
    telaVantagens();

    selectCampoVeiculo();


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

    function verificaCadastroMotorista(email) {
        dados2 = {
            funcao: "verificaCadastroMotorista",
            email: email
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            if(data == 'pendente'){
                $('.esconde').removeClass('pagina-ativa');
                $('#pageCadastro').addClass('pagina-ativa');
                $('.navegacao').hide();
                $('.main-sidebar').hide();
            }else if (data == 'pendenteVeiculo'){
                $('.esconde').removeClass('pagina-ativa');
                $('#PageCadastroVeiculo').addClass('pagina-ativa');
                $('.navegacao').hide();
                $('.main-sidebar').hide();
            }
        });
    }
    function selectCampoMotorista(email, campo, id) {
        dados2 = {
            funcao: "selectCampoMotorista",
            email: email,
            campo: campo
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            $(id).html(data);
        });
    }
    function selectImgMotorista(email, campo, id) {
        dados2 = {
            funcao: "selectCampoMotorista",
            email: email,
            campo: campo
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            $(id).attr('src', "http://99cargas.com/site/assets/images/avatar/user-" + data + ".png");
        });
    }
    function selectCampoMotoristaCadastro(email, campo, id) {
        dados2 = {
            funcao: "selectCampoMotorista",
            email: email,
            campo: campo
        };
        var envia = $.param(dados2);
        $.post(baseUrlRequest, envia, function (data) {
            $(id).val(data);
        });
    }

    function selectCampoVeiculo() {
        let dados2 = {
            funcao: "selectCampoVeiculo",
            email: userEmail
        };
        var envia = $.param(dados2);
        $.ajax({
            url: baseUrlRequest,
            type: "get",
            dataType: "json",
            data: envia,
            async: false,
            success: function (data) {
                if(data == "" || data == null){}else{
                    $("#placaVeiculo").val(data.placaVeiculo);
                    $("#renavam").val(data.renavam);
                    $("#marcaVeiculo").val(data.marcaVeiculo);
                    $("#modeloVeiculo").val(data.modeloVeiculo);
                    $("#anoFab").val(data.anoFab);
                    $("#anoMod").val(data.anoMod);
                    $("#placaCarreta").val(data.placaCarreta);

                }
            }

        });
    }

    function telaAjuda(){
        $.get(baseUrlRequest + "?funcao=telaAjuda", function (data) {
            $(".telaPerguntas").html(data);
        });
    }

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

    function telaCargaTransportadas(){

        var dados = {
            funcao: "telaCargaTransportadas",
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
    function telaCargaTransportando(){

        var dados = {
            funcao: "telaCargaTransportando",
            email: userEmail
        };
        let envia = $.param(dados);

        $.get(baseUrlRequest + "?" + envia, function (data) {
            $('#resultadoCargasTransportando').html(data);
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
    function telaVantagens(){

        var dados = {
            funcao: "telaVantagens",
            email: userEmail
        };
        let envia = $.param(dados);

        $.get(baseUrlRequest + "?" + envia, function (data) {
            $('#telaVantagens').html(data);
        });
    }

    function enviarLocal() {
        var startPos;
        var geoSuccess = function(position) {
            startPos = position;
            dados = {
                lat: startPos.coords.latitude,
                long: startPos.coords.longitude,
                funcao: "enviarLocal",
                email: userEmail
            };
            let envia = $.param(dados);
            $.post(baseUrlRequest, envia, function () {

            });
        };

        setInterval(rodaGeo , 10000);
        function rodaGeo(){
            navigator.geolocation.getCurrentPosition(geoSuccess);
        }
    }


    function pushAlert(){
        let dados = {
            email: userEmail,
            funcao: "pegaPush"
        };
        let envia = $.param(dados);
        let res;
        $.ajax({
            url: baseUrlRequest,
            type: "get",
            dataType: "json",
            data: envia,
            async: false,
            success: function (data) {
                if(data == "" || data == null){}else{
                    res = data;
                    let id = 1;
                    for(let i = 0; i < res.length; i++){
                        cordova.plugins.notification.local.schedule({
                            id: id,
                            title: String(res[i].titulo),
                            text: String(res[i].mensagem),
                            foreground: true
                        });
                        id++;
                    }

                    telaAvisos();
                }
            }

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
            form_data.append("funcao", 'attAvatar');
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
                }
            });
        }
    });
    $('#atualizaCadastro').on('click', function (event) {
        event.preventDefault();
        if($('#cpfCadastro').val() == '' ){
            alert('O campo CPF é obrigatório');
        }else{
            let formId = $(this).parent();
            let envia = formId.serialize();
            $.post(baseUrlRequest, envia, function (data) {
                alert("Cadastro Atualizado!");
                $('.esconde').removeClass('pagina-ativa');
                $('#PageCadastroVeiculo').addClass('pagina-ativa');
                $('.navegacao').hide();
                $('.main-sidebar').hide();
            });
        }



    });

    
    $('.pesquisaCargaCidade').keyup(function () {
        var data = {
            campo: $('.pesquisaCargaCidade').val(),
            funcao: "pesquisaCargaCidade"
        };
        var envia = $.param(data);

        $.post(baseUrlRequest, envia, function (data) {

            $('#resultadoCargasDisponiveis').html(data);

            $('.aceitarCarga').on('click', function (event) {
                event.preventDefault();
                let form = $(this).parent().parent().attr('id');
                let campo = $("#" + form + " input.idCarga").val();
                let temp = {
                    funcao: "pegaPlaca",
                    email: userEmail
                };
                var envia = $.param(temp);
                $.post(baseUrlRequest, envia, function (data) {
                    var placa = data;
                    var temp2 = {
                        funcao: "aceitarFrete",
                        placa: placa,
                        id: campo,
                        email: userEmail
                    };
                    var envia2 = $.param(temp2);
                    $.post(baseUrlRequest, envia2, function (data) {
                        alert(data);
                        $(location).attr("href", "template.html");
                    });
                });
            });

        });
    });

    $('#pesquisaCargaEstado').on('change', function (event) {
        event.preventDefault();
        var data = {
            campo: $('#pesquisaCargaEstado').val(),
            funcao: "pesquisaCargaEstado"
        };
        var envia = $.param(data);
        $.post(baseUrlRequest, envia, function (data) {
            $('#resultadoCargasDisponiveis').html(data);

            $('.aceitarCarga').on('click', function (event) {
                event.preventDefault();
                let form = $(this).parent().parent().attr('id');
                let campo = $("#" + form + " input.idCarga").val();
                let temp = {
                    funcao: "pegaPlaca",
                    email: userEmail
                };
                var envia = $.param(temp);
                $.post(baseUrlRequest, envia, function (data) {
                    var placa = data;
                    var temp2 = {
                        funcao: "aceitarFrete",
                        placa: placa,
                        id: campo,
                        email: userEmail
                    };
                    var envia2 = $.param(temp2);
                    $.post(baseUrlRequest, envia2, function (data) {
                        alert(data);
                        $(location).attr("href", "template.html");
                    });
                });
            });

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

    $('#cadastroVeiculo').on('click', function (event) {
        event.preventDefault();
        if($('#placaVeiculo').val() == '' || $('#renavam').val() == '' || $('#marcaVeiculo').val() == '' || $('#modeloVeiculo').val() == '' || $('.campoObV').val() == ''){
            alert("Preencha todos os campos obrigatórios *")
        }else{

            let form = $('#formCadastroVeiculo').serialize();
            $.post(baseUrlRequest, form, function (data) {
                alert(data);
                $(location).attr("href", "template.html");
            });
        }
    });
    $('.sairApp').on('click', function (event) {
        event.preventDefault();
        $(location).attr("href", "../template.html");
    });
    $('.cpf').change(function () {
        let campo = $('.cpf').val();
        $('.cpf').val(campo.slice(0,3)+"."+campo.slice(3,6)+"."+campo.slice(6,9)+"-"+campo.slice(9,11));
    });
    $('#removerVeiculo').on('click', function (event) {
       event.preventDefault();
        let dados2 = {
            funcao: "removerVeiculo",
            email: userEmail
        };
        var envia = $.param(dados2);
        $.ajax({
            url: baseUrlRequest,
            type: "get",
            dataType: "json",
            data: envia,
            async: false,
            success: function (data) {
                $(location).attr("href", "template.html");
            }

        });
    });


});

