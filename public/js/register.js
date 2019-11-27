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
var mail = gEName('email')[0];
var password = gEName('password')[0];
var cPassword = gEName('password_confirmation')[0];

function submitForm(event) {
  event.preventDefault();

  var errorPW = '';

  if (cPassword.value !== password.value) {
    gEId('error-cpw').innerHTML = 'Vos mots de passe ne sont pas identiques.';
  } else {
    if (validatePassword(password.value) === false) {
      errorPW = 'Votre mot de passe doit contenir au moins 8 caractères, ';
      errorPW += 'dont une minuscule, une majuscule, un chiffre et un symbole';
      gEId('error-cpw').innerHTML = errorPW;
    }
  }

  var errorMail = '';
  if (mail.value == '') {
    errorMail = 'Veuillez renseigner un email.';
  } else {
    if (validateEmail(mail.value) === false) {
      errorMail = 'Votre email n\'est pas valide.';
    } else existEmail();
  }
  gEId('error-mail').innerHTML = errorMail;

  var errorName = '';
  if (validateString(name.value) === false || name.value.length < 1 || name.value.length > 50) {
    errorName = 'Nom invalide.';
  }
  gEId('error-name').innerHTML = errorName;
}

function existEmail() {
  var request;
  if (window.XMLHttpRequest)
    request = new XMLHttpRequest();
  else
    request = new ActiveXObject('Microsoft.XMLHTTP');

  request.open('POST', '/verification-email', true);
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.setRequestHeader('X-CSRF-TOKEN', getToken());
  request.responseType = 'text';
  var data =
    'data-mail=' + mail.value;
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var answer = this.responseText;
      if (answer === 'true') {
        var errorMail = 'L\'adresse email est déjà utilisée';
        gEId('error-mail').innerHTML = errorMail;
      } else {
        submitForm2();
      }
    } else if (this.readyState == 4 && this.status != 200) {
      alert('erreur ' + this.status);
    }
  }
  request.send(data);
}

function submitForm2() {
  if (errors === 0) {
    gEId('account-creation').submit();
  }
}

function getToken() {
  var meta = gEName('csrf-token')[0];
  return meta.getAttribute('content');
}

// Event listeners

submitBtn.addEventListener('click', submitForm);

// Code to execute
