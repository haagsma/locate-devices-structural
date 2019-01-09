var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageLogin").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "login.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageIdentificacao").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "identificacao.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageCadastroCliente").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "cadastro-cliente.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageCadastroMotorista").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "cadastro-motorista.html", true);
ajuda.send();
