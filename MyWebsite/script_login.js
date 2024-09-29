document.addEventListener("DOMContentLoaded", (event) => {
  console.log('script del login caricato correttamente');

  let username = document.getElementById("username");
  let feedbackusername = document.getElementById("feedbackusername");
  username.addEventListener("blur", CheckUsername);

  let password = document.getElementById("password");
  let feedbackpassword = document.getElementById("feedbackpassword");
  password.addEventListener("blur", CheckPassword);

  let button = document.querySelector("button");
  let form = document.querySelector("form");

  button.addEventListener("click", function (event) {
    const UserValid = CheckUsername();
    const passwordValid = CheckPassword();

    if (!UserValid || !passwordValid) {
      console.log("Uno o più campi non sono stati compilati correttamente");
      event.preventDefault(); // Impedisce l'invio del modulo
    } else {
      console.log("Dati correttamente inviati al DB");
      // L'invio del modulo verrà gestito dall'azione predefinita
    }
  });
  
  // Aggiungi gli ascoltatori di eventi per input e pulsante
  document.addEventListener("input", validateButton);
  
  // Funzione per validare il nome utente
  function CheckUsername() {
    let UserValid = true;
    // Ottieni il valore del campo nome utente
    let usernameValue = username.value;

    // Espressioni regolari per la validazione
    let hasUppercase = /[A-Z]/.test(usernameValue);
    let hasLowercase = /[a-z]/.test(usernameValue);
    let hasNumber = /[0-9]/.test(usernameValue);
    let hasSpecialChar = /[^a-zA-Z0-9]/.test(usernameValue);

    if (usernameValue.length === 0) {
      feedbackusername.textContent = "Username obbligatorio";
      feedbackusername.style.color='red';
      UserValid = false;
    } else if (usernameValue.length > 16) {
      feedbackusername.textContent =
        "Username non può essere superiore ai 16 caratteri";
      UserValid = false;
    } else if (usernameValue.length < 6) {
      feedbackusername.textContent = "Username deve essere di almeno 6 caratteri";
      feedbackusername.style.color='red';
      UserValid = false;
    } else if (hasSpecialChar) {
      feedbackusername.textContent =
        "Username non può contenere caratteri speciali";
        feedbackusername.style.color='red';
      UserValid = false;
    } else if (!hasUppercase) {
      feedbackusername.textContent =
        "Username deve contenere almeno una lettera maiuscola";
        feedbackusername.style.color='red';
      UserValid = false;
    } else if (!hasLowercase) {
      feedbackusername.textContent =
        "Username deve contenere almeno una lettera minuscola";
        feedbackusername.style.color='red';
      UserValid = false;
    } else if (!hasNumber) {
      feedbackusername.textContent = "Username deve contenere almeno un numero";
      feedbackusername.style.color='red';
      UserValid = false;
    } else {
      feedbackusername.textContent = "";
      UserValid = true;
    }

    return UserValid;
  }

  // Funzione per validare la password
  function CheckPassword() {
    let passwordValid = true;
    // Ottieni il valore del campo password
    let passwordValue = password.value;

    // Espressioni regolari per la validazione
    let hasUppercase = /[A-Z]/.test(passwordValue);
    let hasLowercase = /[a-z]/.test(passwordValue);
    let hasNumber = /[0-9]/.test(passwordValue);

    if (passwordValue.length === 0) {
      feedbackpassword.textContent = "Password obbligatoria";
      feedbackpassword.style.color='red';
      passwordValid = false;
    } else if (passwordValue.length > 16) {
      feedbackpassword.textContent =
        "Password non può essere superiore ai 16 caratteri";
        feedbackpassword.style.color='red';
      passwordValid = false;
    } else if (passwordValue.length < 6) {
      feedbackpassword.textContent = "Password deve essere di almeno 6 caratteri";
      feedbackpassword.style.color='red';
      passwordValid = false;
    } else if (!hasUppercase) {
      feedbackpassword.textContent =
        "Password deve contenere almeno una lettera maiuscola";
        feedbackpassword.style.color='red';
      passwordValid = false;
    } else if (!hasLowercase) {
      feedbackpassword.textContent =
        "Password deve contenere almeno una lettera minuscola";
        feedbackpassword.style.color='red';
      passwordValid = false;
    } else if (!hasNumber) {
      feedbackpassword.textContent = "Password deve contenere almeno un numero";
      feedbackpassword.style.color='red';
      passwordValid = false;
    } else {
      feedbackpassword.textContent = "";
      passwordValid = true;
    }

    return passwordValid;
  }

  // Funzione per abilitare o disabilitare il pulsante di invio
  function validateButton() {
    const UserValid = CheckUsername();
    const passwordValid = CheckPassword();
    button.disabled = !(UserValid && passwordValid);
  }

});
