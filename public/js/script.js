
/* Ocultar nombres */
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
	  sidebar.classList.toggle("active");
	  if(sidebar.classList.contains("active")){
		sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
	  }
	  else
		sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
	  }

/* Cambio del recuadro mas oscuro cuando se presiona en un nav-link */
function cambiar(idElem){

	var elementos = document.getElementsByClassName("active");
	var idActive = elementos[0].id;

	var elementoAnterior = document.getElementById(idElem);
	var elementoActual = document.getElementById(idActive);

	elementoActual.classList.remove("active");
	elementoAnterior.classList.add("active");
}

/* Búsqueda de email en Clientes */
function buscarEmail(){
	let email = document.getElementById("emailCliente").value;
	let emails = document.getElementById("clienteEmails");
	let elementos = emails.querySelectorAll("td");
	let clienteEncontrado = false;
	elementos.forEach(elemento => {
	  if (elemento.textContent === email) {
		clienteEncontrado = true;
		window.location.href = "/clientes/"+email;
	  }
	});
	if (!clienteEncontrado) {
	  alert(`No se encontró ningún cliente con el email ${email}`);
	}
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
