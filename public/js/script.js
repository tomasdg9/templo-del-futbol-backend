
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
document.querySelector('.bx-search').addEventListener('click', () => {
	const email = document.getElementById("emailporbuscar").value;
	const divEmails = document.getElementById("clientes-email");
	const elementos = divEmails.querySelectorAll('a');
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
});