/*eslint-env browser*/

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

// Variables

var email = gEName('email')[0];
var name = gEName('name')[0];
//var address = gEName('address')[0];
//var zipCode = gEName('zip')[0];
//var city = gEName('city')[0];
//var radius = gEName('radius')[0];
var errors;

// Functions

String.prototype.replaceAll = function(search, replacement) {
	var target = this;
	return target.split(search).join(replacement);
};

function validatePassword(pw) {
	var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$-/:-?{-~!"^_`\[\]])(?=.{8,})/;
	return re.test(pw);
}

function validateEmail(email) {
	var re = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
	return re.test(email);
}

function validateString(str) {
	var re = /^(?=.*[A-Z])(?=.{2,})/i;
	return re.test(str);
}

function validateForm(e) {
	e.preventDefault();
	errors = 0;

	var errorName = '';
	if (validateString(name.value) === false || name.length > 50) {
		errorName = 'Prénom invalide.';
		errors++;
	}
	gEId('error-name').innerHTML = errorName;

//	var errorAddress = '';
//  if (document.body.contains(address)) {
//		if (validateString(address.value) === false) {
//			errorAddress = 'Format d\'adresse invalide.';
//			errors++;
//		}
//		gEId('error-address').innerHTML = errorAddress;
//	}
//
//	var errorZcode = '';
//  if (document.body.contains(zipCode)) {
//		if (zipCode.value.length !== 5) {
//			errorZcode = 'Le code postal doit contenir 5 caractères.';
//			errors++;
//		}
//		gEId('error-zip').innerHTML = errorZcode;
//	}
//
//	var errorCity = '';
//  if (document.body.contains(city)) {
//    if (city.value.length < 2) {
//      errorCity = 'Veuillez renseigner un nom de ville valide.';
//      errors++;
//    }
//    gEId('error-city').innerHTML = errorCity;
//  }
//
//	var errorRadius = '';
//	if (document.body.contains(radius)) {
//		if (radius.value.length < 2 || radius.value.length > 3) {
//			errorRadius = 'Rayon d\'action invalide.';
//			errors++;
//		}
//		gEId('error-radius').innerHTML = errorRadius;
//	}

	var errorMail = '';
	if (email.value == '') {
		errorMail = 'Veuillez renseigner un email.';
	} else {
		if (validateEmail(email.value) === false) {
			errorMail = 'Votre email n\'est pas valide.';
		} else {
			var currentMail = email.dataset.email;
			if (currentMail !== email.value) {
				existEmail();
			} else {
				submitForm();
			}
		}
	}
	gEId('error-mail').innerHTML = errorMail;

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
    'data-mail='+email.value;
  request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var answer = this.responseText;
      if (answer === 'true') {
				var errorMail = 'L\'adresse email est déjà utilisée';
				gEId('error-mail').innerHTML = errorMail;
      }
      else {
				submitForm();
      }
    }
    else if (this.readyState == 4 && this.status != 200) {
      alert('erreur '+this.status);
    }
  }
  request.send(data);
}

function submitForm() {
	if (errors === 0) {
		var confirmationText = 'Modification(s) enregistrée(s)';
		gEId('confirmation-profile').innerHTML = confirmationText;
		gEId('profile-form').submit();
	}
}

function validatePasswords(){
	var oPass = gEName('password')[0];
	var nPass = gEName('npassword')[0];
	var cPass = gEName('cpassword')[0];
	var errorPw = '';
	var errorNPsw = '';
	var errorFPsw = '';
  errors = 0;

	if(oPass.value === nPass.value){
		errorPw = 'Rentrez un mot de passe différent de l\'ancien.';
    errors++;
    console.log(errorPw);
  }
  gEId('error-pw').innerHTML = errorPw;

  if(validatePassword(cPass.value) === false){
		errorFPsw = 'Votre mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un symbole.';
    errors++;
  }
  gEId('error-cpw').innerHTML = errorFPsw;

  if(nPass.value !== cPass.value){
		errorNPsw = 'Vos mots de passe ne sont pas identiques.';
    errors++;
  }
  gEId('error-npw').innerHTML = errorNPsw;

  if (errors === 0){
		submitForm();
	}
}

function verifiatePass(event) {
	event.preventDefault();
	var request = new XMLHttpRequest();

	request.open('POST', '/ajaxChangePsw', true);
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.setRequestHeader('X-CSRF-TOKEN', getToken());
	request.responseType = 'text';
  
	var data = 'data-pass='+gEName('password')[0].value;
  console.log(data);
	request.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var answer = this.responseText;
      var errorOPsw = '';
			if (answer === 'false') {
				errorOPsw = 'Mot de passe non valide.';
        gEId('error-pw').innerHTML = errorOPsw;
			}
			else if (answer === 'true'){
				validatePasswords();
			}
		}
		else if (this.readyState == 4 && this.status != 200) {
			alert('erreur '+this.status);
		}
	}
  request.send(data);
}

function getToken() {
  var meta = gEName('csrf-token')[0];
  return meta.getAttribute('content');
}


// Event listeners

gEName('submit-btn')[0].addEventListener('click', validateForm);
gEName('submit-btn')[1].addEventListener('click', verifiatePass);

// Code to execute
