require("./bootstrap.js");

// recoge los datos de localstorage
var mujeres = new Array();
var mujeres = JSON.parse(localStorage.getItem("mujeres"));

// creo el array de preguntas para recoger preguntas del api
let arrayPreguntas = new Array();
for (i = 0; i < mujeres.length; i++) {
  $.get("/api/preguntas/" + mujeres[i].id, function (data) {
    console.log(data);
    // console.log(data.pregunta);
    console.log("tamaño de las preguntas " + data);
    console.log("meto pregunta" + i);
    arrayPreguntas.push(data);
  })
}

var player = "X";
var ai = "O";
var winner, gameboard, playing;

var mensaje = document.querySelector("#contenedor-mensaje");
var TituloMensaje = document.getElementById("titulo-mensaje");
var btnMensaje = document.getElementById("btnCerrarMensaje");

// Muestro el mensaje primero 
if (mensaje.classList.contains("ocultar-mensaje")) {
  mensaje.classList.remove("ocultar-mensaje");
  TituloMensaje.innerHTML = "Tu simbolo es X, puedes cambiar si quieres. <b>Instrucciones: </b> Cada vez que vayas a tirar te hara una pregunta, si la respuesta esta mal perderas el turno.";
}
// al pulssar el boton para cerrar el mensaje
btnMensaje.onclick = function () {
  mensaje.classList.add("ocultar-mensaje");
  reset();
}

// cuando el simbolo elegido es X
window.$("#symbol-X").click(function () {
  player = "X";
  ai = "O";
  window.$("#symbol-O").removeClass("glow");
  console.log("El jugador es: " + player);
  reset();
});

// cuando el simbolo elegido es O
window.$("#symbol-O").click(function () {
  player = "O";
  ai = "X";
  window.$("#symbol-X").removeClass("glow");
  console.log("El jugador es: " + player);
  reset();
});

// Funcion para resetear el juego
function reset() {
  setTimeout(function () {
    start();
    window.$('.square').removeClass("glow");
    console.log("game reset");
    window.$('.square').html("");
  }, 1500);
};

// los valores iniciales del juego
function start() {
  window.$('#symbol-' + player).addClass('glow');
  gameboard = ["", "", "", "", "", "", "", "", ""];
  playing = true;
  winner = "none";
}

function getEmptySpaces(board) {
  return board.reduce(function (results, square, index) {
    if (square !== "") {
      return results;
    } else {
      return results.concat(index);
    }
  }, []);
}

function aiTurn() {
  console.log("computer's turn");
  var available = getEmptySpaces(gameboard);
  console.log(available);
  // el juego se para temporalmente si es empate
  if (available.length === 0) {
    //Aqui se empata 
    mensaje = document.querySelector("#contenedor-mensaje");
    if (mensaje.classList.contains("ocultar-mensaje")) {
      mensaje.classList.remove("ocultar-mensaje");
      TituloMensaje.innerHTML = "Es un empate.";
    }
    return console.log("Es un empate");
  }

  var aiIndex = available[Math.floor(Math.random() * available.length)];
  console.log(aiIndex);
  gameboard[aiIndex] = ai;
  window.$("#sq" + aiIndex).html(ai);
};

function checkForWinner(board) {
  // comprueba las condiciones de la partida 
  var winCon = [
    // Horizontal
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    // Vertical
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    // Diagonal
    [0, 4, 8],
    [2, 4, 6],
  ];
  for (var i = 0; i < winCon.length; i++) {
    var cond = winCon[i];
    // si une los 3 en raya
    if (board[cond[0]] !== "" && board[cond[0]] === board[cond[1]] && board[cond[1]] === board[cond[2]]) {
      winner = board[cond[0]];
      playing = false;
      window.$('#sq' + cond[0]).addClass('glow');
      window.$('#sq' + cond[1]).addClass('glow');
      window.$('#sq' + cond[2]).addClass('glow');

      // gana el jugador
      if (winner == player) {
        // muestra el mensaje
        mensaje = document.querySelector("#contenedor-mensaje-victoria");
        if (mensaje.classList.contains("ocultar-mensaje")) {
          mensaje.classList.remove("ocultar-mensaje");
        }
        // ejecuta el boton de 
        window.$("#guardar").click(function (evt) {
          console.log("va ha cerrar");
          window.location.href = '/juegos';

          $arrayMujeresAGuardar = new Array();
          for (var i = 0; mujeres.length > i; i++) {
            $arrayMujeresAGuardar.push(mujeres[i].id);
            console.log("puseando mujer");
          }
          window.location.href = '/guardarmujerperfil/' + $arrayMujeresAGuardar;
          console.log("¡¡HAS GANADO!!");
        });
      }

      // gana el BOT
      else {
        mensaje = document.querySelector("#contenedor-mensaje-derrota");
        if (mensaje.classList.contains("ocultar-mensaje")) {
          mensaje.classList.remove("ocultar-mensaje");
        }

        console.log("Has Perdido :(");
        // opcion de click en el boton 
        window.$("#otrapartida").click(function (evt) {
          console.log("va ha cerrar");
          window.location.href = '/juegos';
        });
      }

      console.log(winner + " Wins!");
      reset();
      break;
    }
  }
  if (getEmptySpaces(gameboard).length === 0 && winner === "none") {
    console.log("Game tie!");
    reset();
  }
};
var playerSelector;
var playerPick;
window.$("#gameboard").click(function (e) {

  //end game when winner delcared 
  if (!playing) return;
  playerPick = (e.target.id).slice(2);
  playerSelector = "#sq" + playerPick;
  console.log(playerPick);

  console.log(playerSelector);
  if (gameboard[playerPick] != "") {
    //Aqui el usuario pierde el turno si ha pulsado en la casilla de AI
    return;
  };

  if (gameboard[playerPick] == "") {

    console.log(arrayPreguntas);
    console.log("has clickado el cuadro");
    mensaje = document.querySelector("#cuestionario");
    mensaje.style.display = "block";

    //Escojemos la pregunta y se la lanzamos
    //escojemos la pregunta
    var numerorandom = Math.floor(Math.random() * arrayPreguntas.length);
    var pregunta = arrayPreguntas[numerorandom];
    arrayPreguntas.splice(numerorandom, 1);
    //Se la lanzamos
    $("#pregunta").html(pregunta.pregunta);
    document.getElementById("respuestas").options.length = 0;//Vaciamos las options 

    //Añadimos las respuestas para la pregunta inicial
    for (i = 0; i < pregunta.respuestas.length; i++) {
      $('#respuestas').append($('<option />', {
        text: pregunta.respuestas[i].respuesta,
        value: pregunta.respuestas[i].correcta,
      }));
    }
    //Validaremos la respuesta
    window.$("#validar").click(function (evt) {

      console.log("se ejecuta el click");
      mensaje.style.display = "none";
      console.log("dentro " + " #sq" + playerPick);
      if (document.getElementById("respuestas").value == "true") {
        gameboard[playerPick] = player;
        console.log("pos  actual " + gameboard[playerPick]);
        console.log("playerselector " + playerSelector)
        $(playerSelector).html(player);
        if (playing) {
          aiTurn();
          console.log(gameboard);
          console.log("hago el checkforwinner");
          checkForWinner(gameboard);
        }
      }
      else {
        aiTurn();
        console.log("hago el checkforwinner");
        checkForWinner(gameboard);
      }
      evt.stopImmediatePropagation();
    });
  };
});

start();