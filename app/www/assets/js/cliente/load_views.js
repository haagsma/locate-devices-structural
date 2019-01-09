var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageInicio").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "inicio.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageAjuda").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "ajuda.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageCarga").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "carga.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageCadastro").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "cadastro.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageMensagem").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "mensagem.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageAvisos").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "avisos.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageCargaTransportando").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "carga-transportando.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageCargaTransportada").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "carga-transportadas.html", true);
ajuda.send();
var ajuda = new XMLHttpRequest();
ajuda.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pageTermos").innerHTML = this.responseText;
    }
};
ajuda.open("GET", "termos.html", true);
ajuda.send();
