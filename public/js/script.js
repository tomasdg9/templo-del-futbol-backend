
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
var page = 1;
/* AJAX Clientes */
$(document).ready(function() {
    $('#siguientePag').click(function() {
        page++;
        console.log(page);
        $.ajax({
            url: '/api/clientes/' + page,
            type: 'GET',
            success: function(response) {
          // Obtenemos el elemento tbody de la tabla
var tbody = document.getElementById('tablaClientes');

// Limpiamos la tabla antes de agregar nuevos elementos
tbody.innerHTML = '';

// Recorremos el JSON y creamos una fila por cada objeto
for(var i=0; i<response.length; i++) {
    var cliente = response[i];

    // Creamos una nueva fila
    var row = document.createElement('tr');

    // Agregamos el ID en una columna
    var idColumn = document.createElement('td');
    idColumn.textContent = cliente.id;
    row.appendChild(idColumn);

    // Agregamos el Email en una columna
    var emailColumn = document.createElement('td');
    emailColumn.textContent = cliente.email;
    row.appendChild(emailColumn);

    // Agregamos la fila a la tabla
    tbody.appendChild(row);
}


            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

