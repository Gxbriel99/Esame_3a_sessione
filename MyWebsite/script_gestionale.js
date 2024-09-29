document.addEventListener("DOMContentLoaded", () => {
  console.log("script del gestionale corretamente caricato");

  // Elementi form
  const insertForm = document.getElementById("insert");
  const editForm = document.getElementById("edit");
  const deleteForm = document.getElementById("delete");

  // Funzione per nascondere tutti i form
  function hideAllForms() {
    insertForm.style.display = "none";
    editForm.style.display = "none";
    deleteForm.style.display = "none";
  }

  // Inizialmente nascondi tutti i form
  hideAllForms();

  // Pulsanti
  const buttons = document.querySelectorAll("#sidemenu button");

  // Assegna eventi ai pulsanti
  buttons[0].addEventListener("click", () => {
    hideAllForms(); // Nascondi tutto
    insertForm.style.display = "block"; // Mostra il form di inserimento
  });

  buttons[1].addEventListener("click", () => {
    hideAllForms(); // Nascondi tutto
    editForm.style.display = "block"; // Mostra il form di modifica
  });

  buttons[2].addEventListener("click", () => {
    hideAllForms(); // Nascondi tutto
    deleteForm.style.display = "block"; // Mostra il form di eliminazione
  });

  // Gestisci il titolo e il messaggio per tutti gli input della classe "title"
  const titleElements = document.querySelectorAll(".title");
  titleElements.forEach((title) => {
    title.addEventListener("blur", () => CheckTitle(title));
  });

  // Gestisci il messaggio per tutti gli input della classe "msg"
  const msgElements = document.querySelectorAll(".msg");
  msgElements.forEach((msg) => {
    msg.addEventListener("blur", () => CheckMsg(msg));
  });
});

// Funzione per controllare il titolo
function CheckTitle(title) {
  const feedbackTitle = title.nextElementSibling; // Seleziona il feedback relativo
  const invio = title.closest("form").querySelector(".invio"); // Seleziona il pulsante invio del form

  let title_Value = title.value;

  if (title_Value.length <= 1) {
    feedbackTitle.textContent = "Il campo è obbligatorio";
    feedbackTitle.style.color = "red";
    title.style.border = "solid red 1px";
    invio.setAttribute("disabled", "");
  } else {
    feedbackTitle.textContent = "";
    title.style.border = "solid green 2px";
    invio.removeAttribute("disabled");
  }
}

// Funzione per controllare il messaggio
function CheckMsg(msg) {
  const feedbackMsg = msg.nextElementSibling; // Seleziona il feedback relativo
  const invio = msg.closest("form").querySelector(".invio"); // Seleziona il pulsante invio del form

  let msg_Value = msg.value;

  if (msg_Value.length <= 1) {
    feedbackMsg.textContent = "Il campo è obbligatorio";
    feedbackMsg.style.color = "red";
    msg.style.border = "solid red 1px";
    invio.setAttribute("disabled", "");
  } else {
    feedbackMsg.textContent = "";
    msg.style.border = "solid green 2px";
    invio.removeAttribute("disabled");
  }
}
