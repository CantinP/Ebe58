/*eslint-env browser*/

// Variables

var type = 'patient-validation';
var titleGui = [
	'mail validation de compte (patient)',
	'mail validation de compte (praticien)',
	'mail validation de compte (admin)',
	'mail contact',
	'mail récupération mot de passe'
]

// Functions

function changeType(num, kind) {
	type = kind;

	var request;
  if (window.XMLHttpRequest)
		request = new XMLHttpRequest();
  else
    request = new ActiveXObject('Microsoft.XMLHTTP');

  request.open('POST', '/toggle-mail-type', true);
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	request.setRequestHeader('X-CSRF-TOKEN', getToken());
  request.responseType = 'text';
  var data =
		'data-type='+type;

  request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var answer = this.responseText;
			answer = answer.split('?%%');
			gEId('title-gui').innerHTML = titleGui[num];
			gEName('object')[0].value = answer[0];
			gEName('mail')[0].innerHTML = answer[1];
    }
    if (this.readyState == 4 && this.status != 200) {
      alert('erreur '+ this.status);
    }
  }
  request.send(data);
}

// Events listeners

gETag('button')[0].addEventListener('click', function () {
	changeType(0, 'patient-validation');
});

gETag('button')[1].addEventListener('click', function () {
	changeType(1, 'practitioner-validation');
});

gETag('button')[2].addEventListener('click', function () {
	changeType(2, 'admin-validation');
});

gETag('button')[3].addEventListener('click', function () {
	changeType('3', 'contact');
});

gETag('button')[4].addEventListener('click', function () {
	changeType(4, 'lost-password');
});

gEName('save-btn')[0].addEventListener('click', function(event) {
	event.preventDefault();

	var request;
  if (window.XMLHttpRequest)
		request = new XMLHttpRequest();
  else
    request = new ActiveXObject('Microsoft.XMLHTTP');

  request.open('POST', '/update-mail', true);
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	request.setRequestHeader('X-CSRF-TOKEN', getToken());
  request.responseType = 'text';
  var data =
		'data-type='+type+
		'&data-object='+gEName('object')[0].value+
		'&data-message='+gEName('mail')[0].value;

  request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status != 200) {
      alert('erreur '+ this.status);
    }
  }
  request.send(data);
});

// code to execute
