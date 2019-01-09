$(document).ready(function () {

    $('.targetPage').click(function(event){
        event.preventDefault();
        var target = $(this).attr('dt-page');
        $('.esconde').removeClass('pagina-ativa');
        $(target).addClass('pagina-ativa');
    });
    $('.cnh').change(function () {
        let campo = $('.cnh').val();
        $('.cnh').val(campo.slice(0,13));
    });
    $('.cpf').change(function () {
        let campo = $('.cpf').val();
        $('.cpf').val(campo.slice(0,3)+"."+campo.slice(3,6)+"."+campo.slice(6,9)+"-"+campo.slice(9,11));
    });
    $('.cnpj').change(function () {
        let campo = $('.cnpj').val().replace('.', "").replace("/", "").replace("-", "");
        $('.cnpj').val(campo.slice(0,2)+"."+campo.slice(2,5)+"."+campo.slice(5,8)+"/"+campo.slice(8,12)+"-"+campo.slice(12,14));
    });
});

