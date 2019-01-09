jQuery(function($){
        $(".cep-origem").change(function(){
            var cep_code = $(this).val();
            console.log($(this).val());
            let dados = {
              cep: cep_code,
                formato: 'jsonp'
            };
            let envia = $.param(dados);
            $.ajax({
                url:    "http://cep.republicavirtual.com.br/web_cep.php",
                type:   "get",
                dataType:"json",
                data:   envia,
                async: false,

                success: function( result ){
                    /* aqui coloca o OBJ dentro da variavel publica*/
                    console.log(result);
                    if(result.resultado !== 0){
                        $("input.estado-origem").val( result.uf );
                        $("input.cidade-origem").val( result.cidade );
                        $("input.bairro-origem").val( result.bairro );
                        $("input.endereco-origem").val( result.tipo_logradouro + " "+ result.logradouro );
                    }
                }
            });
            /*if( cep_code.length <= 0 ) return;
            $.get("https://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
                function(result){
                console.log(result);
                if(result.status !== 0){
                    $("input.cep-origem").val( result.code );
                    $("input.estado-origem").val( result.state );
                    $("input.cidade-origem").val( result.city );
                    $("input.bairro-origem").val( result.district );
                    $("input.endereco-origem").val( result.address );
                }

                });*/
        });
		$(".cep_destino").change(function(){
            var cep_code = $(this).val();
            let dados = {
                cep: cep_code,
                formato: 'jsonp'
            };
            let envia = $.param(dados);
            $.ajax({
                url:    "http://cep.republicavirtual.com.br/web_cep.php",
                type:   "get",
                dataType:"json",
                data:   envia,
                async: false,

                success: function( result ){
                    /* aqui coloca o OBJ dentro da variavel publica*/
                    console.log(result);
                    if(result.resultado !== 0){
                        $("input.estado_destino").val( result.uf );
                        $("input.cidade_destino").val( result.cidade );
                        $("input.bairro_destino").val( result.bairro );
                        $("input.endereco_destino").val( result.tipo_logradouro + " " + result.logradouro );
                    }
                }
            });
            /*if( cep_code.length <= 0 ) return;
            $.get("https://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
                function(result){
                    if(result.status !== 0) {
                        $("input.cep_destino").val(result.code);
                        $("input.estado_destino").val(result.state);
                        $("input.cidade_destino").val(result.city);
                        $("input.bairro_destino").val(result.district);
                        $("input.endereco_destino").val(result.address);
                    }
                });*/
        });
    });