const socket = io("http://localhost:3000");

let chatActivo = null;

// usuario online
socket.emit("usuario_online", USER_ID);

// abrir chat
function abrirChat(id){
    chatActivo = id;

    socket.emit("entrar_chat", id);

    document.getElementById("chatBox").style.display = "block";
}

// enviar mensaje
function enviarMensaje(){
    let msg = document.getElementById("mensaje_input").value;

    socket.emit("mensaje", {
        chat_id: chatActivo,
        usuario: USER_NAME,
        mensaje: msg
    });

    document.getElementById("mensaje_input").value = "";
}

// recibir mensaje
socket.on("mensaje_nuevo", (data) => {

    let div = document.createElement("div");

    let clase = (data.usuario === USER_NAME)
        ? "msg-derecha"
        : "msg-izquierda";

    div.classList.add("msg", clase);

    div.innerHTML = `<b>${data.usuario}</b><br>${data.mensaje}`;

    document.getElementById("mensajes").appendChild(div);
});