const logo = document.querySelector("#menu");
const navegacion = document.querySelector(".nav-li");

logo.addEventListener("click", () => {
    navegacion.classList.toggle("mostrar");
});


// Agarramos el formulario y el párrafo donde vamos a avisar.
const formularioPedido = document.querySelector("#form-pedido");
const avisoPedido = document.querySelector("#error-pedido");

// La función recibe el evento como parámetro. Se llama "event"
// por costumbre; es la información de lo que acaba de pasar.
function revisarPedido(event) {
  // Freno de mano: sin esta línea la página se recarga y no
  // llegamos ni a revisar. Es LA línea nueva del día.
  event.preventDefault();

  // .value es lo que hay escrito adentro de la casilla, ahora.
  const nombre = document.querySelector("#nombre").value;
  const telefono = document.querySelector("#telefono").value;
  const correo = document.querySelector("#correo").value;
  const mensaje = document.querySelector("#mensaje").value;

  if (nombre === "") {
    // Dos comillas pegadas significan "texto vacío": no escribió nada.
    avisoPedido.textContent = "Falta tu nombre, caserito.";
    avisoPedido.classList.add("error");
    avisoPedido.classList.remove("exito");
  } else if (telefono === "") {
    avisoPedido.textContent = "Falta tu número de teléfono.";
    avisoPedido.classList.add("error");
    avisoPedido.classList.remove("exito");
  } else if (correo.includes("@") === false) {
    // includes revisa si un texto contiene otro. No comprueba que
    // el correo exista: comprueba que PAREZCA un correo.
    avisoPedido.textContent = "Ese correo no parece correo: le falta el @.";
    avisoPedido.classList.add("error");
    avisoPedido.classList.remove("exito");
  } else if (mensaje === "") {
    avisoPedido.textContent = "Falta escribir tu pedido de carne.";
    avisoPedido.classList.add("error");
    avisoPedido.classList.remove("exito");
  } else {
    // Pasó las dos revisiones: recién ahí avisamos que está bien.
    avisoPedido.textContent = "Pedido de carne recibido, caserito. Te contactamos hoy.";
    avisoPedido.classList.add("exito");
    avisoPedido.classList.remove("error");
  }
}

// Igual que en las dos misiones anteriores: seleccionar, escuchar,
// reaccionar. Lo único que cambia es el nombre del evento.
// Y la función va SIN paréntesis, como siempre.
formularioPedido.addEventListener("submit", revisarPedido);
