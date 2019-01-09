jQuery(function($){
        $(".cep-origem").change(function(){
            var cep_code = $(this).val();
            console.log($(this).val());
            if( cep_code.length <= 0 ) return;
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

                });
        });
		$(".cep_destino").change(function(){
            var cep_code = $(this).val();
            if( cep_code.length <= 0 ) return;
            $.get("https://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
                function(result){
                    if(result.status !== 0) {
                        $("input.cep_destino").val(result.code);
                        $("input.estado_destino").val(result.state);
                        $("input.cidade_destino").val(result.city);
                        $("input.bairro_destino").val(result.district);
                        $("input.endereco_destino").val(result.address);
                    }
                });
        });
    });