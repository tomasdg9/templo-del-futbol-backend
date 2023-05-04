
/* Categorias. Texto de páginas, Botón "Anterior", "Siguiente" y "Buscar categoria" */
var items = $('div[name="categoria"]');
var textoMostrnado = $('#mostrando');
var inicio = 0;
var fin = 6;
var cantidadPaginas = 0;
var paginaActual = 1;
reiniciarPaginas();

function reiniciarPaginas(){
    items.hide();
    inicio = 0;
    fin = 6;
    items.slice(inicio, fin).show();
    cantidadPaginas = Math.ceil(items.length / 6);
    paginaActual = 1;
    textoMostrnado.text("Mostrando "+paginaActual+" de "+cantidadPaginas+" páginas");
}

$("#nextButton").click(function() {
    if(inicio + 6 < items.length ) {
        inicio = inicio + 6;
        fin = fin + 6;
        paginaActual++;
        items.hide();
        items.slice(inicio, fin).show();
        textoMostrnado.text("Mostrando "+paginaActual+" de "+cantidadPaginas+" páginas");
    }
});

$("#prevButton").click(function() {
    if(inicio - 6 >= 0) {
        inicio = inicio - 6;
        fin = fin - 6;
        items.hide();
        paginaActual--;
        items.slice(inicio, fin).show();
        textoMostrnado.text("Mostrando "+paginaActual+" de "+cantidadPaginas+" páginas");
    }
});

/* Cambio del recuadro mas oscuro cuando se presiona en un nav-link */
function cambiar(idElem){

	var elementos = document.getElementsByClassName("active");
	var idActive = elementos[0].id;

	var elementoAnterior = document.getElementById(idElem);
	var elementoActual = document.getElementById(idActive);

	elementoActual.classList.remove("active");
	elementoAnterior.classList.add("active");
}

/* Cambiar botón de nombre en categorias */
function cambiarNombre(idDocumento, primerTexto, segundoTexto){ //
	let boton = document.getElementById(idDocumento);
	if(boton.textContent === primerTexto)
		boton.textContent = segundoTexto
	else
		boton.textContent = primerTexto
}

/* Busca la fecha actual y la inserta en idDoc*/ 
function fechaActual(idDoc){
	document.getElementById(idDoc).value = new Date().toISOString().slice(0,10);
}

function filtrarPedidos(){
	var fechaInicio = document.getElementById("start").value;
	var fechaFin = document.getElementById("finish").value;	
}
