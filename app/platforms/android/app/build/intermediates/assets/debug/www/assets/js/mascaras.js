
$('.peso').mask('9999999999999,9' , { reverse: true });
$('.telefone').mask('(99) 9999-9999' );
$('.celular').mask('(00) 00000-0000' );
$('.cpf').mask('999.999.999-99' );
$('.cnpj').mask('99.999.999/9999-99' );
$('.brl').mask('9999.999.999.999,99' , { reverse: true });

$('.celular').blur(function () {
    if($(this).val().length < 15){
        $(this).val('');
        swal('Digite um numero válido', 'Numero inválido', 'error');
    }
});

$('.cpf').blur(function () {
    let cpf = $('.cpf').val().replace(".", "").replace(".", "").replace("-", "");
    let teste = TestaCPF(cpf);
    if(teste == false){
        $('.cpf').val('');
        swal('Digite um CPF válido', '', 'error');
    }
});
function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}