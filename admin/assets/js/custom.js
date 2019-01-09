$(document).ready(function () {
    $('#btnEnviarFreteMaps').on('click', function (event) {
        event.preventDefault();
        let titulo = $('.tituloEnvia').val();
        let mensagem = $('.mensagemEnvia').val();
        for(let i = 0; i < markers.length; i++){
            let dados = {
              titulo: titulo,
              mensagem: mensagem,
              placa: markers[i].title
            };
            let envia = $.param(dados);
            $.ajax({
                url:    "functions/push.php",
                type:   "get",
                data:   envia,
                async: false,
                success: function( data ){
                    /* aqui coloca o OBJ dentro da variavel publica*/
                    if(data == 'sucesso'){
                        swal("Avisos enviados!", "", "success").then((value) => {
                            $(location).attr('href', '99-mapa.php');
                        });
                    }else {
                        swal("Houve uma falha, atualize a página e tente novamente!", "", "error");
                    }

                }
            });
        }
    });
});