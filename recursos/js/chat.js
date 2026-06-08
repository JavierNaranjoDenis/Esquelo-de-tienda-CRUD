let chatActivo = null;

function abrirChat(id) {
    chatActivo = id;

    document.getElementById("chat_id_input").value = id;
    document.getElementById("chatBox").style.display = "block";

    cargarMensajes();

    
    setTimeout(() => {
        let box = document.getElementById("mensajes");
        box.scrollTop = box.scrollHeight;
    }, 300);
}


function cargarMensajes() {

    if (!chatActivo) return;

    fetch("../ajax/mensajes.php?chat_id=" + chatActivo)
        .then(r => r.text())
        .then(html => {

            let box = document.getElementById("mensajes");
            box.innerHTML = html;

          
            box.scrollTop = box.scrollHeight;
        });
}


function enviarMensaje(e) {
    e.preventDefault();

    let form = document.getElementById("formChat");
    let data = new FormData(form);

    fetch("../ajax/enviar_mensaje.php", {
        method: "POST",
        body: data
    }).then(() => {

        document.getElementById("mensaje_input").value = "";
        cargarMensajes();

    });

    return false;
}


setInterval(() => {
    if (chatActivo) {
        cargarMensajes();
    }
}, 2000);