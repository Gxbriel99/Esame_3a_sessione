document.addEventListener("DOMContentLoaded", () => {
  // Questo evento viene attivato quando il DOM è completamente caricato
  console.log("script del homepage caricato correttamente");

  SalutoDinamico(); // Funzione per visualizzare un saluto in base all'ora

  // Aggiunta di eventi di validazione ai campi di input
  const nome = document.getElementById("nome");
  nome.addEventListener("blur", CheckName); 

  const cognome = document.getElementById('cognome');
  cognome.addEventListener('blur', CheckCognome);

  const email = document.getElementById('email');
  email.addEventListener('blur', CheckEmail);

  const msg = document.getElementById('msg');
  msg.addEventListener('blur', CheckMsg);

  // Riferimenti al form e al pulsante di invio
  const form = document.getElementById("client_Form_Message");
  const button = document.getElementById("invia");

  const checkbox = document.getElementById('policy');
  checkbox.addEventListener('change', validatePolicy); // Ascolta i cambiamenti sul checkbox
  
  const menuItems = document.querySelectorAll('.hamburger-menu ul li');
  const check = document.getElementById('controllo');

  // Evento che chiude il menu quando clicco su un ancora
  menuItems.forEach(item => {
    item.addEventListener('click', function () {
      check.checked = false; // Chiude il menu impostando la checkbox su false
    });
  });

  // Evento di invio del form
  form.addEventListener("submit", (event) => {
    event.preventDefault(); // Previene il caricamento della pagina

    // Controlla la validità di ciascun campo
    const NameValid = CheckName();
    const CognomeValid = CheckCognome();
    const EmailValid = CheckEmail();
    const MsgValid = CheckMsg();
    const policyValid = validatePolicy();

    // Log della validità dei campi
    console.log("NameValid:", NameValid);
    console.log("CognomeValid:", CognomeValid);
    console.log("EmailValid:", EmailValid);
    console.log("MsgValid:", MsgValid);
    console.log("PolicyValid:", policyValid);

     // Abilita il pulsante solo se tutti i campi sono validi
     if (NameValid && CognomeValid && EmailValid && MsgValid && policyValid) {
      form.submit(); // Invia il modulo se tutti i campi sono validi
    } else {
      console.log("Correggere gli errori nel form");
    }
  });

});

// Funzione per mostrare un saluto dinamico
function SalutoDinamico() {
  let time = new Date();
  let ora = time.getHours();
  let saluto = document.getElementById("saluto");

  // Determina il saluto in base all'ora del giorno
  if (ora >= 6 && ora < 14) {
    saluto.textContent = "BUONGIORNO";
  } else if (ora >= 14 && ora < 18) {
    saluto.textContent = "BUON POMERIGGIO";
  } else {
    saluto.textContent = "BUONASERA";
  }
}
// Funzione per controllare la validità del campo Nome
function CheckName() {
  const nome = document.getElementById("nome");
  const nome_value = nome.value;
  let feedbackNome = document.getElementById("feedbackNome");
  let NameValidation = true;

  // Controlli di validazione
  const hasNumber = /[0-9]/.test(nome_value);
  const specialCharset = /[!@#$%^&*(),.?":{}|<>]/.test(nome_value);

  // Validazione delle condizioni
  if (nome_value.length === 0) {
    feedbackNome.textContent = "Il campo è obbligatorio";
    nome.style.border = "1px solid red";
    feedbackNome.style.color = "red";
    feedbackNome.style.padding = "0 20px";
    NameValidation = false;
  } else if (nome_value.length < 5 || nome_value.length > 30) {
    feedbackNome.textContent = "inserire un nome valido";
    nome.style.border = "1px solid red";
    feedbackNome.style.color = "red";
    feedbackNome.style.padding = "0 20px";
    NameValidation = false;
  } else if (hasNumber) {
    feedbackNome.textContent = "Il nome non può contenere numeri";
    nome.style.border = "1px solid red";
    feedbackNome.style.color = "red";
    feedbackNome.style.padding = "0 20px";
    NameValidation = false;
  } else if (specialCharset) {
    feedbackNome.textContent = "Il nome non può contenere caratteri speciali";
    nome.style.border = "1px solid red";
    feedbackNome.style.color = "red";
    feedbackNome.style.padding = "0 20px";
    NameValidation = false;
  } else {
    // Condizione di successo
    feedbackNome.textContent = "";
    nome.style.borderBottom = "1px solid black";
    nome.style.borderTop = "none";
    nome.style.borderRight = "none";
    nome.style.borderLeft = "none";
    feedbackNome.style.color = "black";
    feedbackNome.style.padding = "0";
    NameValidation = true;
  }

  return NameValidation; // Restituisce il risultato della validazione
}
// Funzione per controllare la validità del campo Cognome
function CheckCognome() {
  const cognome = document.getElementById("cognome");
  const cognome_value = cognome.value;
  let feedbackCognome = document.getElementById("feedbackCognome");
  const hasNumber = /[0-9]/.test(cognome_value);
  const specialCharset = /[!@#$%^&*(),.?":{}|<>]/.test(cognome_value);
  let cognomeValidation = true;

  // Controlli di validazione simili a quelli di CheckName
  if (cognome_value.length === 0) {
    feedbackCognome.textContent = "Il campo è obbligatorio";
    cognome.style.border = "1px solid red";
    feedbackCognome.style.color = "red";
    feedbackCognome.style.padding = "0 20px";
    cognomeValidation = false;
  } else if (cognome_value.length <= 1 || cognome_value.length > 30) {
    feedbackCognome.textContent = "Il cognome non può essere superiore ai 30 caratteri o inferiore a 5";
    cognome.style.border = "1px solid red";
    feedbackCognome.style.color = "red";
    feedbackCognome.style.padding = "0 20px";
    cognomeValidation = false;
  } else if (hasNumber) {
    feedbackCognome.textContent = "Il cognome non può contenere numeri";
    cognome.style.border = "1px solid red";
    feedbackCognome.style.color = "red";
    feedbackCognome.style.padding = "0 20px";
    cognomeValidation = false;
  } else if (specialCharset) {
    feedbackCognome.textContent = "Il cognome non può contenere caratteri speciali";
    cognome.style.border = "1px solid red";
    feedbackCognome.style.color = "red";
    feedbackCognome.style.padding = "0 20px";
    cognomeValidation = false;
  } else {
    // Condizione di successo
    feedbackCognome.textContent = "";
    cognome.style.borderBottom = "1px solid black";
    cognome.style.borderTop = "none";
    cognome.style.borderRight = "none";
    cognome.style.borderLeft = "none";
    feedbackCognome.style.color = "black";
    feedbackCognome.style.padding = "0";
    cognomeValidation = true;
  }

  return cognomeValidation; // Restituisce il risultato della validazione
}
// Funzione per controllare la validità del campo Email
function CheckEmail() {
  const email = document.getElementById('email');
  const email_value = email.value;
  const feedbackEmail = document.getElementById('feedbackEmail');
  const emailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  let emailValidation = true;

  // Controlla se l'email è valida
  if (!emailPattern.test(email_value)) { 
    feedbackEmail.textContent = "Inserire un'email valida";
    email.style.border = "1px solid red";
    feedbackEmail.style.color = "red";
    feedbackEmail.style.padding = "0 20px";
    emailValidation = false;
  } else {
    // Condizione di successo
    feedbackEmail.textContent = "";
    email.style.borderTop = "none";
    email.style.borderRight = "none";
    email.style.borderLeft = "none";
    email.style.borderBottom = "1px solid black";
    feedbackEmail.style.color = "black";
    feedbackEmail.style.padding = "0";
    emailValidation = true;
  }

  return emailValidation; // Restituisce il risultato della validazione
}
// Funzione per controllare la validità del campo Messaggio
function CheckMsg() {
  const msg = document.getElementById('msg');
  const msg_value = msg.value;
  const feedbackMsg = document.getElementById('feedbackMsg');
  let msgValidation = true;

  // Controlli di validazione per il messaggio
  if (msg_value.length >= 255) {
    feedbackMsg.textContent = "Limite di caratteri raggiunto";
    msg.style.border = "1px solid red";
    feedbackMsg.style.color = "red";
    feedbackMsg.style.padding = "0 20px";
    msgValidation = false;
  } else if (msg_value.length <= 1) {
    feedbackMsg.textContent = "Il campo è obbligatorio";
    msg.style.border = "1px solid red";
    feedbackMsg.style.color = "red";
    feedbackMsg.style.padding = "0 20px";
    msgValidation = false;
  } else {
    // Condizione di successo
    feedbackMsg.textContent = "";
    msg.style.border = "1px solid black";
    feedbackMsg.style.color = "black";
    feedbackMsg.style.padding = "0";
    msgValidation = true;
  }

  return msgValidation; // Restituisce il risultato della validazione
}
// Funzione per validare la selezione della checkbox
function validatePolicy() {
  const checkbox = document.getElementById('policy');
  const feedbackPolicy = document.getElementById('feedbackPolicy');
  let PolicyValidation = true;

  if (!checkbox.checked) {
    feedbackPolicy.textContent = 'Il campo è obbliogatorio';
    feedbackPolicy.style.color = "red";
    feedbackPolicy.style.padding = "0 8px";
    feedbackPolicy.style.textAlign = "center";
    PolicyValidation = false;
  } else {
    feedbackPolicy.textContent = '';  // Rimuove il messaggio se la casella è selezionata
    PolicyValidation = true;
  }
  console.log('Checkbox checked:', checkbox.checked);

  return PolicyValidation;
}
