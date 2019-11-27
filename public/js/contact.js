// Functions

function gEId(E) {
  return document.getElementById(E);
}

function gEClass(E) {
  return document.getElementsByClassName(E);
}

function gEName(E) {
  return document.getElementsByName(E);
}

function gETag(E) {
  return document.getElementsByTagName(E);
}

function validatePassword(pw) {
  var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$-/:-?{-~!"^_`\[\]])(?=.{8,})/;
  return re.test(pw);
}

function validateEmail(mail) {
  var re = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
  return re.test(mail);
}

function validateString(str) {
  var re = /^(?=.*[A-Z])(?=.{2,})/i;
  return re.test(str);
}

var submitBtn = gEName('submit_btn')[0];
var name = gEName('name')[0];
var receiver = gEName('receiver')[0];
var subject = gEName('subject')[0];
var message = gEName('message')[0];
var mail = gEName('email')[0];

function submitForm(event) {
  event.preventDefault();

  var errorMail = '';
  if (mail.value == '') {
    errorMail = 'Veuillez renseigner un email.';
  } else {
    if (validateEmail(mail.value) === false) {
      errorMail = 'Votre email n\'est pas valide.';
    }
  }
  gEId('error-mail').innerHTML = errorMail;

  var errorName = '';
  if (validateString(name.value) === false || name.value.length < 1 || name.value.length > 50) {
    errorName = 'Nom invalide.';
  }
  gEId('error-name').innerHTML = errorName;

  var errorReceiver = '';
  if (validateString(receiver.value) === false || receiver.value != "sav" || receiver.value != "support") {
    errorReceiver = 'Veuillez sélectionner un destinataire.';
  }
  gEId('error-receiver').innerHTML = errorReceiver;

  var errorSubject = '';
  if (validateString(subject.value) === false || subject.value.length < 1 || subject.value.length > 50) {
    errorSubject = 'Sujet invalide.';
  }
  gEId('error-subject').innerHTML = errorSubject;

  var errorMessage = '';
  if (validateString(message.value) === false || message.value.length < 20) {
    errorMessage = 'Message trop court.';
  }
  gEId('error-message').innerHTML = errorMessage;
}

function getToken() {
  var meta = gEName('csrf-token')[0];
  return meta.getAttribute('content');
}

// Event listeners

submitBtn.addEventListener('click', submitForm);

// Code to execute
