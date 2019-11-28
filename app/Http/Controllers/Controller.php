<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthentificatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use App\User;

require('Model.php');
require('functions.php');

class Controller extends BaseController
{
  //Login page
	public function ebe58Login(Request $request){
    if (Auth::user() && Auth::user()->rank === 0 || Auth::user() && Auth::user()->rank > 0){
        abort(404);
  	}
		$socials = socialDisp();
		return view('auth.login', ['socials' => $socials]);
	}

  //register page
	public function ebe58Register(Request $request){
    if (Auth::user() && Auth::user()->rank === 0 || Auth::user() && Auth::user()->rank > 0){
        abort(404);
  	}
		$socials = socialDisp();
		return view('auth.register', ['socials' => $socials]);
	}

  //home page
  public function index(Request $request)
  {
		$newsHome = displayNewsHome();
		$socials = socialDisp();
		$token = $request->session()->get('password_hash');
		$profile = profil($token);
		$id_users = $profile['id'];
		$request->session()->put('id', $id_users);
    $sectionDisp = activity();

    $texts = getTexts('home');
    return view('home', ['texts' => $texts, 'socials' => $socials, 'newsHome' => $newsHome, 'sectionDisp' => $sectionDisp]);
  }

  //partner page
  public function partnerDisplay(Request $request){
		$socials = socialDisp();
    $result = viewPartner();

    foreach($result as $results){
    $name = $results -> name;
    $link = $results -> link;
    $logo = $results -> logo;
    $description = $results -> description;
    $id = $results -> id;
    }

    return view('partner', ['name' => $name, 'link' => $link, 'logo' => $logo, 'description' => $description, 'id' => $id, 'result' => $result, 'socials' => $socials]);
  }

  public function section(Request $request){
		$socials = socialDisp();
    $sectionDisp = activity();

    $id = Input::get('id');
    $result = activityDisplay($id);

    return view('section', ['result' => $result, 'socials' => $socials, 'sectionDisp' => $sectionDisp]);
  }

  public function partner(Request $request){
		$socials = socialDisp();
    $result = viewPartner();

    foreach($result as $results){
    $name = $results -> name;
    $link = $results -> link;
    $logo = $results -> logo;
    $description = $results -> description;
    $id = $results -> id;
    }

    echo var_dump($results -> name);

    return view('partners', ['name' => $name, 'link' => $link, 'logo' => $logo, 'description' => $description, 'id' => $id, 'result' => $result, 'socials' => $socials]);
  }

  public function partnerModify(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
		$socials = socialDisp();
    $id = Input::get('id');
    $result = partnerView($id);

    return view('modify-partner', ['result' => $result, 'socials' => $socials]);
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function backoffice(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
		$socials = socialDisp();
      return view('backoffice',[ 'socials' => $socials]);
    }
    abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function deletePartner(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
    $id = Input::get('id');

    partnerDelete($id);

    return redirect()->to('/partners')->send();
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function dispTexts(Request $request){
		$socials = socialDisp();
    $textsHome = displayTexts('home');
    $textsCredits = displayTexts('credits');
    $textsQui = displayTexts('qui');
    return view('texts', ['textsHome' => $textsHome, 'textsCredits' => $textsCredits, 'textsQui' => $textsQui, 'socials' => $socials]);
  }

  public function modifyPartner(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){

      $id = Input::get('id');
      $name = Input::get('name');
      $link = Input::get('link');
      $description = Input::get('description');
      $image = $request->file('logo');
      $img = Input::get('logoancient');

      $name = filter_var($name, FILTER_SANITIZE_MAGIC_QUOTES);
      $link = filter_var($link, FILTER_SANITIZE_MAGIC_QUOTES);
      $description = filter_var($description, FILTER_SANITIZE_MAGIC_QUOTES);

      $img_name = $img;
      $fldr = './partner/';

      if(!empty($image)){
        $img_name = generate();
        $img_name .= '.png';
        move_uploaded_file($image, $fldr.$img_name);
      }
      elseif(empty($image) && empty($img)){
        $img_name = "NULL";
      }

      if(!empty($name) || !empty($link) || !empty($img_name) || !empty($description)){
        partnerUpdate($name, $link, $img_name, $description, $id);
			 return redirect()->to('/partners')->send();
      }
      else{
		    return redirect()->to('/partners')->send();
      }
    }
    abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function partnerCreate(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){

      $name = Input::get('name');
      $link = Input::get('link');
      $description = Input::get('description');
      $image = $request->file('logo');

      $name = filter_var($name, FILTER_SANITIZE_MAGIC_QUOTES);
      $link = filter_var($link, FILTER_SANITIZE_MAGIC_QUOTES);
      $description = filter_var($description, FILTER_SANITIZE_MAGIC_QUOTES);

      $img_name = '';
      $fldr = './partner/';

      if(!empty($image)){
        $img_name = generate();
        $img_name .= '.png';
        move_uploaded_file($image, $fldr.$img_name);
      }
      elseif(empty($image)){
        $img_name = "NULL";
      }

      if(!empty($name) || !empty($link) || !empty($img_name) || !empty($description)){
        addPartner($name, $link, $img_name, $description);
			 return redirect()->to('/partners')->send();
      }
      else{
		    return redirect()->to('/partners')->send();
      }

    }
    abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function modifyText(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){

      $text = Input::get('text');
      $title = Input::get('title');

      $text = filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES);
      $title = filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES);

      if(!empty($text) || !empty($title)){
        updateText($text, $title);
        return redirect()->to('/texts')->send();
      }
      else{
		    return redirect()->to('/texts')->send();
      }

    }
    abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function activityDisplay(Request $request){
		$socials = socialDisp();
    $sectionDisp = activity();

    return view('activity', ['socials' => $socials, 'sectionDisp' => $sectionDisp]);
  }

  public function activityCreation(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
		$socials = socialDisp();

    return view('create-activity', ['socials' => $socials]);
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function activityModify(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
		$socials = socialDisp();

    $id = Input::get('id');
    $result = activityView($id);

    return view('modify-activity', ['result' => $result, 'socials' => $socials]);
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function createSection(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
    $name = Input::get('name');
    $logo = $request->file('logo');
    $btn = $request->file('buttonActivity');
    $link = Input::get('link');
    $banner = $request->file('banner');
    $color = Input::get('textcolor');
    $text = Input::get('text');
    $text2 = Input::get('text2');
    $video = Input::get('video');
    $pdf = $request->file('pdf');

    $errorMsg = [];
    $errors = 0;

    $name = filter_var($name, FILTER_SANITIZE_MAGIC_QUOTES);
    $link = filter_var($link, FILTER_SANITIZE_MAGIC_QUOTES);
    $banner = filter_var($banner, FILTER_SANITIZE_MAGIC_QUOTES);
    $logo = filter_var($logo, FILTER_SANITIZE_MAGIC_QUOTES);
    $btn = filter_var($btn, FILTER_SANITIZE_MAGIC_QUOTES);
    $text = filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES);
    $text2 = filter_var($text2, FILTER_SANITIZE_MAGIC_QUOTES);
    $video = filter_var($video, FILTER_SANITIZE_MAGIC_QUOTES);
    $pdf = filter_var($pdf, FILTER_SANITIZE_MAGIC_QUOTES);

    $fldr = 'banner/';

    if(!empty($banner)){
      $img_name = generate();
      $img_name .= '.jpg';
      move_uploaded_file($banner, $fldr.$img_name);
      if(!is_uploaded_file($banner)){
        $errors++;
        array_push($errorMsg, 'La bannière ne s\'upload pas.');
      }
    }

    $fldrlogo = 'logo/';

    if(!empty($logo)){
      $logo_name = generate();
      $logo_name .= '.jpg';
      move_uploaded_file($logo, $fldrlogo.$logo_name);
      if(!is_uploaded_file($logo)){
        $errors++;
        array_push($errorMsg, 'le logo ne s\'upload pas.');
      }
    }

    $fldrbtn = 'button/';

    if(!empty($btn)){
      $btn_name = generate();
      $btn_name .= '.jpg';
      move_uploaded_file($btn, $fldrbtn.$btn_name);
      if(!is_uploaded_file($btn)){
        $errors++;
        array_push($errorMsg, 'le bouton ne s\'upload pas.');
      }
    }

    if(!empty($pdf)) {
      $fldrpdf = 'pdf/';
      $size_file = filesize($pdf);
      if($size_file < 20000000) {
        $pdf_name = generate();
        $pdf_name .= '.pdf';
        move_uploaded_file($pdf, $fldrpdf.$pdf_name);
      }
      else{
        $errors++;
        array_push($errorMsg, 'PDF trop volumineux.');
      }
      if(!is_uploaded_file($pdf)){
        $errors++;
        array_push($errorMsg, 'Le PDF ne s\'upload pas.');
      }
    }
    else{
      $pdf_name = '#';
    }

    if($name != '' && $link != '' && $text != '' && $text2 != '' && $color != ''){
      addActivity($name, $link, $img_name, $text, $text2, $video, $color, $pdf_name, $logo_name, $btn_name);
      return redirect()->to('/activités')->send();
    }
    else{
      $errors++;
      array_push($errorMsg, 'Problème dans vos champs.');
		  return view('error', ['errors' => $errorMsg]);
    }
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function sendActivityModify(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
    $id = Input::get('id');
    $name = Input::get('name');
    $link = Input::get('link');
    $banner = $request->file('banner');
    $logo = $request->file('logo');
    $btn = $request->file('buttonActivity');
    $text = Input::get('text');
    $text2 = Input::get('text2');
    $video = Input::get('video');
    $color = Input::get('color');
    $pdf = $request->file('pdf');

    $errorMsg = [];
    $errors = 0;

    $name = filter_var($name, FILTER_SANITIZE_MAGIC_QUOTES);
    $link = filter_var($link, FILTER_SANITIZE_MAGIC_QUOTES);
    $banner = filter_var($banner, FILTER_SANITIZE_MAGIC_QUOTES);
    $logo = filter_var($logo, FILTER_SANITIZE_MAGIC_QUOTES);
    $btn = filter_var($btn, FILTER_SANITIZE_MAGIC_QUOTES);
    $text = filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES);
    $text2 = filter_var($text2, FILTER_SANITIZE_MAGIC_QUOTES);
    $video = filter_var($video, FILTER_SANITIZE_MAGIC_QUOTES);
    $pdf = filter_var($pdf, FILTER_SANITIZE_MAGIC_QUOTES);

    $fldr = './banner/';

    if(!empty($banner)){
      $img_name = generate();
      $img_name .= '.jpg';
      move_uploaded_file($banner, $fldr.$img_name);
      if(!is_uploaded_file($banner)){
        $errors++;
        array_push($errorMsg, 'La bannière ne s\'upload pas.');
      }
    }
    else if(empty($banner)){
      $img_name = Input::get('bannerancient');
    }

    $fldrlogo = './logo/';

    if(!empty($logo)){
      $logo_name = generate();
      $logo_name .= '.jpg';
      move_uploaded_file($logo, $fldrlogo.$logo_name);
      if(!is_uploaded_file($logo)){
        $errors++;
        array_push($errorMsg, 'le logo ne s\'upload pas.');
      }
    }
    else if(empty($logo)){
      $logo_name = Input::get('logoancient');
    }

    $fldrbtn = './button/';

    if(!empty($btn)){
      $btn_name = generate();
      $btn_name .= '.jpg';
      move_uploaded_file($btn, $fldrbtn.$btn_name);
      if(!is_uploaded_file($btn)){
        $errors++;
        array_push($errorMsg, 'le bouton ne s\'upload pas.');
      }
    }
    else if(empty($btn)){
      $btn_name = Input::get('buttonancient');
    }

    if(!empty($pdf)) {
      $fldrpdf = './pdf/';
      $size_file = filesize($pdf);
      if($size_file < 20000000) {
        $pdf_name = generate();
        $pdf_name .= '.pdf';
        move_uploaded_file($pdf, $fldrpdf.$pdf_name);
      }
      else{
        $errors++;
        array_push($errorMsg, 'PDF trop volumineux.');
      }
      if(!is_uploaded_file($pdf)){
        $errors++;
        array_push($errorMsg, 'Le PDF ne s\'upload pas.');
      }
    }
    else if(empty($pdf)){
      $pdf_name = Input::get('pdfancient');
    }

    if($name != '' && $link != '' && $text != '' && $text2 != '' && $color != ''){
      activityUpdate($name, $link, $img_name, $text, $text2, $video, $color, $id, $pdf_name, $logo_name, $btn_name);
      return redirect()->to('/activités')->send();
    }
    else{
      $errors++;
      array_push($errorMsg, 'Problème dans vos champs.');
		  return view('error', ['errors' => $errorMsg]);
    }
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function deleteActivity(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
    $id = Input::get('id');

    activityDelete($id);

    return redirect()->to('/activités')->send();
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

	public function contact(){
		$socials = socialDisp();
		return view('contact',['socials' => $socials]);
	}

  public function sendMessage(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			$name = Input::get('name');
			$email = Input::get('email');
			$sjt = Input::get('subject');
			$msg = Input::get('message');
      $receiver = Input::get('receiver');

			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$email = filter_var($email, FILTER_SANITIZE_STRING);
			$sjt = filter_var($sjt, FILTER_SANITIZE_STRING);
			$msg = filter_var($msg, FILTER_SANITIZE_STRING);
			$receiver = filter_var($receiver, FILTER_SANITIZE_STRING);


			// Initializing variables
			$errorMsg = [];
			$errors = 0;

			//Verifiate Inputs
			if (!preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', $email)) {
				$errors++;
				array_push($errorMsg, 'Votre adresse email n\'est pas valide.');
			}
			if (!preg_match('/^(?=.*[A-Z])(?=.{2,})/i', $name) ||
				strlen($name) > 50) {
				$errors++;
				array_push($errorMsg, 'Nom invalide');
			}
			if (strlen($sjt) < 3) {
				$errors++;
				array_push($errorMsg, 'Sujet invalide');
			}
			if (strlen($msg) < 10) {
				$errors++;
				array_push($errorMsg, 'Message invalide');
			}
      if($receiver == 'support' || $receiver == 'sav'){
        echo $receiver;
      }
      else{
				$errors++;
				array_push($errorMsg, 'destinataire non valide');
      }

			if ($errors === 0) {


			//parts for cantin mail

			$message = '<html>
										<body>
											<p>
												Votre mail à bien été reçu, nous allons vous répondre dans les plus brefs délais !
											</p>
										</body>
									</html>';

			$message = wordwrap($message, 70);
			$subject = 'Accusé de réception de votre mail à l\'EBE58';

			$headers = "From: " . $receiver.'@ebe58.fr'. "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			//parts for user mail
			$rmail= $receiver."@ebe58.fr";

			$rmessage = '<html><body>
										<p>'.$msg.'</p>
									</body></html>';

			$rmessage = wordwrap($rmessage, 70);

			$rheaders = "From: " . $email . "\r\n";
			$rheaders .= "MIME-Version: 1.0\r\n";
			$rheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			//send mails
			mail($rmail, $sjt, $rmessage, $rheaders);
			mail($email, $subject, $message, $headers);

			return redirect()->to('/')->send();
			}
			else {
				return view('error', ['errors' => $errorMsg]);
			}
		}
	}

  public function areaProfil(Request $request) {

		if (Auth::user() && Auth::user()->rank === 0) {
		  $socials = socialDisp();

      $password = $request->session()->get('password_hash');
      $rank = "0";
			$account = informations($password, $rank);
			$texts = getTexts('profile');

			$name = $account['name'];
			$email = $account['email'];

      $request->session()->put('email', $email);
      $request->session()->put('name', $name);

      $title = $request->session()->get('name');

      if(!empty($account['address']) && !empty($account['zip']) && $account['city']){

		    $socials = socialDisp();
        $address = $account['address'];
        $zip = $account['zip'];
        $city = $account['city'];


        return view('area-profil', ['title' => $title, 'texts' => $texts, 'name' => $name, 'email' => $email, 'address' => $address, 'zip' => $zip, 'city' => $city, 'email' => $email,  'socials' => $socials]);
      }
      else{

		    $socials = socialDisp();
        $address = "";
        $zip = "";
        $city = "";


        return view('area-profil', ['title' => $title, 'texts' => $texts, 'name' => $name, 'email' => $email, 'address' => $address, 'zip' => $zip, 'city' => $city, 'email' => $email, 'socials' => $socials]);
      }
		}
    if (Auth::user() && Auth::user()->rank === 1) {
		  $socials = socialDisp();

      $password = $request->session()->get('password_hash');
      $rank = "1";
      $account = informations($password, $rank);
      $texts = getTexts('profile');

      $name = $account['name'];
      $email = $account['email'];

      $request->session()->put('email', $email);
      $request->session()->put('name', $name);

      $title = $request->session()->get('name');

      if(!empty($account['service'])){

		    $socials = socialDisp();
        $section = activity();
        $service = $account['service'];

        return view('area-profil', ['title' => $title, 'texts' => $texts, 'name' => $name, 'email' => $email, 'service' => $service, 'section' => $section, 'socials' => $socials]);
      }
      else{

        $section = activity();
        $service = "";

        return view('area-profil', ['title' => $title, 'texts' => $texts, 'name' => $name, 'email' => $email, 'service' => $service, 'section' => $section, 'socials' => $socials]);
      }
    }
    if (Auth::user() && Auth::user()->rank === 2) {
		$socials = socialDisp();

      $password = $request->session()->get('password_hash');
      $rank = "2";
      $account = informations($password, $rank);
      $texts = getTexts('profile');

      $name = $account['name'];
      $email = $account['email'];

      $request->session()->put('email', $email);
      $request->session()->put('name', $name);

      $title = $request->session()->get('name');

			return view('area-profil', ['title' => $title, 'texts' => $texts, 'name' => $name, 'email' => $email, 'socials' => $socials]);
    }
	}

  public function updatePsw(Request $request){
		$password = Input::get('password');
		$npassword = Input::get('new-password');
		$cpassword = Input::get('confirm-password');
		$email = $request->session()->get('email');

		$errorMsg = [];
		$errors = 0;

		$oldPass = $request->session()->get('password-hash');

		if (Hash::check($password, Auth::user()->password)) {

			if($npassword === $password){
				$errors++;
				array_push($errorMsg, 'Rentrez un mot de passe différent de l\'ancien.');
			}
			if ($npassword !== $cpassword) {
				$errors++;
				array_push($errorMsg, 'Vos mots de passe ne sont pas identiques.');
			}
			if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$-.:-?{-~!"^_`\[\]\/])(?=.{8,})/',
				$cpassword)) {
				$errors++;
				array_push($errorMsg, 'Votre mot de passe doit contenir au moins 8
					caractères, dont une majuscule, une minuscule, un chiffre et un
					symbole.');
			}

			$password = filter_var($password);
			$password = password_hash($password, PASSWORD_BCRYPT);
			$npassword = filter_var($npassword);
			$npassword = password_hash($npassword, PASSWORD_BCRYPT);
			$cpassword = filter_var($cpassword);
			$cpassword = password_hash($cpassword, PASSWORD_BCRYPT);


		} else {
			$errors++;
			array_push($errorMsg, 'Ancien mdp mauvais');
		}

		if ($errors !== 0) {
			return view('error', ['errors' => $errorMsg]);
		}
		else{
			updatePsw($email, $cpassword);
				return redirect()->to('/profil')->send();
		}
	}

  public function infosUpdate(Request $request) {

		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			$name = Input::get('name');
			$email = Input::get('email');
			$address = Input::get('address');
			$zip = Input::get('zip');
			$city = Input::get('city');
			$service = Input::get('service');
		  $oldEmail = $request->session()->get('email');

			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$email = filter_var($email, FILTER_SANITIZE_STRING);
			$address = filter_var($address, FILTER_SANITIZE_STRING);
			$zip = filter_var($zip, FILTER_SANITIZE_STRING);
			$city = filter_var($city, FILTER_SANITIZE_STRING);
			$service = filter_var($service, FILTER_SANITIZE_STRING);


			$errorMsg = [];
			$errors = 0;


			if (!preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', $email)) {
				$errors++;
				array_push($errorMsg, 'Adresse mail invalide.');
			}
			elseif ($email !== $oldEmail) {
				$exist = exist($email);
				if ($exist === true) {
					$errors++;
					array_push($errorMsg, 'L\adresse mail saisie existe déjà');
				}
			}

			if (!preg_match('/^(?=.*[A-Z])(?=.{2,})/i', $name) ||
				strlen($name) > 50) {
				$errors++;
				array_push($errorMsg, 'Format de nom invalide.');
			}

			if (Auth::user() && Auth::user()->rank === 0) {

				if (!preg_match('/^(?=.*[A-Z])(?=.{2,})/i', $address)) {
					$errors++;
					array_push($errorMsg, 'Format d\'adresse invalide.');
				}
				if (!preg_match('/^[0-9]{5}$/i', $zip)) {
					$errors++;
					array_push($errorMsg, 'Code postal invalide.');
				}
			}

			if (Auth::user() && Auth::user()->rank === 1) {


			}

			if ($errors === 0) {
				infoUpdate($name, $oldEmail, $email, $address, $zip, $city, $service);

        return redirect()->to('/profil')->send();
      }
			else {
				return view('error', ['errors' => $errorMsg]);
			}
		}
	}

  public function social(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
			$socials = socialDisp();
      return view('social', ['socials' => $socials]);
    }
        abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

  public function addSocial(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
			$name = Input::get('name');
			$remember = Input::get('remember');
			$link = Input::get('link');

			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$link = filter_var($link, FILTER_SANITIZE_STRING);

			if(isset($name) && isset($remember) && isset($link)){
				createSocial($name, $remember, $link);
				return redirect()->to('social')->send();
			}
			else{
				return redirect()->to('social')->send();
			}
  	}
			abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

  public function modifySocial(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){

			$id = Input::get('id');
			$infos = socialModify($id);

			$socials = socialDisp();

      return view('socialModify',['infos' => $infos, 'socials' => $socials]);
    }
        abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
  }

	public function socialUpdate(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){

		$id = Input::get('id');
		$name = Input::get('name');
		$remember = Input::get('remember');
		$oldRemember = Input::get('oldRemember');
		$link = Input::get('link');

		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$link = filter_var($link, FILTER_SANITIZE_STRING);

		if(!isset($remember) || !isset($name) || !isset($link)){
			$remember = $oldRemember;
			socialUp($id, $name, $remember, $link);
			return redirect()->to('social')->send();
		}
		else{
			socialUp($id, $name, $remember, $link);
			return redirect()->to('social')->send();
		}
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

  public function socialDelete(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
			$id = Input::get('id');
			deleteSocial($id);
			return redirect()->to('social')->send();
  	}
		abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

	public function newsDisplay(){
		$result = displayNews();
		$socials = socialDisp();
		$newsHome = displayNewsHome();

    foreach($result as $resulting){
    $title = $resulting -> title;
    $text = substr($resulting -> text, 0 , 100) . '...';
    $image = $resulting -> image;
    $id = $resulting -> id;
    }

		return view('news', ['title' => $title, 'text' => $text, 'image' => $image, 'id' => $id, 'socials' => $socials, 'newsHome' => $newsHome]);
	}

	public function mentions(){
		$socials = socialDisp();

		return view('mentions', ['socials' => $socials]);
	}

	public function credits(){
		$socials = socialDisp();

    $texts = getTexts('credits');

		return view('credits', ['socials' => $socials, 'texts' => $texts]);
	}

	public function qui(){
		$socials = socialDisp();

    $texts = getTexts('qui');

		return view('qui', ['socials' => $socials, 'texts' => $texts]);
	}

	public function newsUnique(){
		$id = Input::get('id');
		$all = uniqueNews($id);
		$socials = socialDisp();

		return view('news-unique', ['all' => $all, 'socials' => $socials]);
	}

	public function newsModify(Request $request){
		if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
			$socials = socialDisp();
			$id_users = $request->session()->get('id');
			$id = Input::get('id');
			$all = uniqueNews($id);
			$id_check = $all -> id_users;

				return view('newsModify', ['all' => $all, 'socials' => $socials]);
		}
		abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

	public function newsAdd(Request $request){
		if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
			$socials = socialDisp();

			return view('news-create', ['socials' => $socials]);
		}
		abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

	public function newsDelete(){
		if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
			$id = Input::get('id');
			deleteNews($id);
			return redirect()->to('actualités')->send();
		}
		abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

	public function newsUpdate(Request $request){
		if (Auth::user() && Auth::user()->rank === 1){
			$id_users = $request->session()->get('id');
			$id = Input::get('id');
			$all = uniqueNews($id);
			$id_check = $all -> id_users;
			if($id_users == $id_check || Auth::user() && Auth::user()->rank === 2){
				$id = Input::get('id');
				$title = Input::get('name');
				$text = Input::get('text');
				$image = $request->file('image');
    		$img = Input::get('oldImg');
        $prio = Input::get('remember');
        $link = Input::get('link');

				$title = filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES);
				$text = filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES);
				$img  = filter_var($img , FILTER_SANITIZE_STRING);
        $link = filter_var($link, FILTER_SANITIZE_STRING);

				$img_name = $img;
				$fldr = 'news/';

				if(!empty($image)){
					$img_name = generate();
					$img_name .= '.png';
					move_uploaded_file($image, $fldr.$img_name);
				}
				elseif(empty($image) && empty($img)){
					$img_name = 'NULL';
				}

        if($prio == true){
          $prio = '1';
        }
        else{
          $prio = '0';
        }
				updateNews($id, $title, $text, $img_name, $prio, $link);
				return redirect()->to('actualités')->send();
			}
			abort(403, 'T\'as pas le droit de toucher à ça !');
		}
		abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

	public function existEmail() {

		if (isset($_POST['data-mail'])) {
			$mail = filter_var($_POST['data-mail'], FILTER_SANITIZE_STRING);
			$exist = exist($mail);
			$exist = ($exist) ? 'true' : 'false';
			return $exist;
		}
	}

	public function newsCreate(Request $request){
		if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
			$title = Input::get('name');
			$text = Input::get('text');
			$img = $request->file('image');
			$id_users = $request->session()->get('id');
      $link = Input::get('link');

			$title = filter_var($title, FILTER_SANITIZE_MAGIC_QUOTES);
			$text = filter_var($text, FILTER_SANITIZE_MAGIC_QUOTES);
			$img  = filter_var($img , FILTER_SANITIZE_STRING);
      $link = filter_var($link, FILTER_SANITIZE_STRING);

			$image = '';
			$fldr = 'news/';

			if(!empty($img)){
				$image = generate();
				$image .= '.jpg';
				move_uploaded_file($img, $fldr.$image);
			}
			elseif($image = '' && empty($img)){
				$image = 'NULL';
			}

			createNews($title, $text, $image, $id_users, $link);
			return redirect()->to('actualités')->send();
		}
		abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
	}

  //part of anaïs

   public function updateProduct(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
            $id = Input::get('id');
		        $socials = socialDisp();
            $section = section();
            $product = showOneProduct($id)[0];
            return view('updateProduct', ['product' => $product, 'section'=> $section, 'socials' => $socials]);
        }
        abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');


    }
    //    this functon allows to update infos on a products.

    public function updateInfos(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
        $id = Input::get('id');
        $product_name = Input::get('productName');
        $product_description = Input::get('productDescription');
        $product_price = Input::get('productPrice');
        $product_height = Input::get('productHeight');
        $product_weight = Input::get('productWeight');
        $product_quantity = Input::get('productQuantity');
        $product_width = Input::get('productWidth');
        $activities = [];
        $activities = Input::get('activities');
        $image = $request->file('img');

        if(empty($image)){
            $img_name = Input::get('lastimage');
            if($product_name != '' || $product_description != '' || $product_price != ''|| $product_height != '' || $product_weight != '' || $product_quantity != '' || $product_width != ''|| $activities != ''){
                productUpdate($id, $product_name, $product_description, $product_price, $product_height, $product_weight, $product_quantity, $product_width, $activities, $img_name);
                return redirect()->to('/')->send();
            }
            elseif($product_name == '' || $product_description == '' || $product_price == ''|| $product_height == '' || $product_weight == '' || $product_quantity == '' || $product_width == ''|| $activities == ''){
                return redirect()->to('/')->send();
            }
        }

        $fldr = "product/";
        if(!empty($image)){
            $img_name = generate();
            $img_name .= '.png';
            move_uploaded_file($image, $fldr.$img_name);
        }elseif(empty($image)){
            $img_name = 'NULL';
        }

        if($product_name != '' || $product_description != '' || $product_price != ''|| $product_height != '' || $product_weight != '' || $product_quantity != '' || $product_width != ''|| $activities != ''){
            productUpdate($id, $product_name, $product_description, $product_price, $product_height, $product_weight, $product_quantity, $product_width, $activities, $img_name);
            return redirect()->to('/')->send();
        }
        elseif($product_name == '' || $product_description == '' || $product_price == ''|| $product_height == '' || $product_weight == '' || $product_quantity == '' || $product_width == ''|| $activities == ''){
            return redirect()->to('/')->send();
        }
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
    }
    //    function to add product

    public function addproduct(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
		        $socials = socialDisp();
            $section = section();
            return view('addproduct',['section'=> $section, 'socials' => $socials]);
        }
        abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');

    }
    //    Add to database

    public function sendProduct(Request $request){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
            $product_name = Input::get('productName');
            $product_description = Input::get('productDescription');
            $product_price = Input::get('productPrice');
            $product_height = Input::get('productHeight');
            $product_weight = Input::get('productWeight');
            $product_quantity = Input::get('productQuantity');
            $product_width = Input::get('productWidth');
            $activities = [];
            $activities = Input::get('activities');
            $image = $request->file('img');

            $fldr = "product/";
            if(!empty($image)){
                $img_name = generate();
                $img_name .= '.png';
                move_uploaded_file($image, $fldr.$img_name);
            }elseif(empty($image)){
                $img_name = 'NULL';
            }

            if($product_name != '' || $product_description != '' || $product_price != ''|| $product_height != '' || $product_weight != '' || $product_quantity != '' || $product_width != ''|| $activities != ''){
                productCreate($product_name, $product_description, $product_price, $product_height, $product_weight, $product_quantity, $product_width, $activities, $img_name);
                return redirect()->to('/addproduct')->send();
            }
            elseif($product_name == '' || $product_description == '' || $product_price == ''|| $product_height == '' || $product_weight == '' || $product_quantity == '' || $product_width == ''|| $activities == ''){
                return redirect()->to('/')->send();
            }
        }
        abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');

    }
    //    this function allows to delete product from the database

    public function deleteProduct(){
    if (Auth::user() && Auth::user()->rank === 1 || Auth::user() && Auth::user()->rank === 2){
            $id = Input::get('id');
            productDelete($id);
            return redirect()->to('/')->send();
        }
        abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
    }

    public function admin(Request $request){
      if (Auth::user() && Auth::user()->rank === 2){
        $socials = socialDisp();
        $admins = adminDisp();

      $id_user = $request->session()->get('id');
      $profile = profilNews($id_user);
        return view('admin', ['socials' => $socials, 'admins' => $admins, 'profile' => $profile]);
      }
          abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
    }

    public function modifyAdmin(Request $request){
      if (Auth::user() && Auth::user()->rank === 2){

        $id = Input::get('id');
        $infos = adminModify($id);

        $socials = socialDisp();

      $id_user = $request->session()->get('id');
      $profile = profilNews($id_user);

        return view('adminModify',['infos' => $infos, 'socials' => $socials, 'profile' => $profile]);
      }
          abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
    }

    public function adminUpdate(Request $request){
      if (Auth::user() && Auth::user()->rank === 2){
        $id = Input::get('id');
        $rank = [];
        $rank = Input::get('rank');

        $rank = filter_var($rank, FILTER_SANITIZE_STRING);

        if($rank == "none"){
          $remember = Input::get('oldRank');

            adminUp($id, $rank);
            return redirect()->to('admin')->send();
        }
        elseif($rank != "none"){

          adminUp($id, $rank);
          return redirect()->to('admin')->send();
        }
      }
        abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
    }

    public function adminDelete(Request $request){
      if (Auth::user() && Auth::user()->rank === 2){
        $id = Input::get('id');
        deleteAdmin($id);
        return redirect()->to('admin')->send();
      }
      abort(403, 'Vous n\'avez pas les droits nécessaire pour voir cette page !');
    }


    public function ajaxUpdatePsw(){
      $password = Input::get('data-pass');
      $email = $request->session()->get('email');

      $oldPass = verifyPassword($email);

      if (password_verify($password, $oldPass)) {
        return 'true';
      }
      else {
        return 'false';
      }
    }

	public function forgotPassword(Request $request){
			$mail = Input::get('mail');
			$random = generate();
			$socials = socialDisp();

			$recover = recoverPassByMail($mail, $random);
			if ($recover) {

				$link = 'https://ebe58.cantin-poiseau.fr/oubli/'.$random;

				$message = '<html><body>'.'Veuillez trouver ci-joint le lien de réinitialisation de mot de passe pour l\'adresse mail '.$mail
										.'<a href="'.$link.'"> 
												<button style="padding:6px 10px;font-size:18px;color:#EEE;background-color:#864;">
												Changer mon mot de passe</button>
											</a>
										</body></html>';

				$message = wordwrap($message, 70);
				$subject = 'Mail de réinitialisation de mot de passe.';

				$headers = "From: " .'contact@ebe58.fr'. "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				//send mail
				mail($mail, $subject, $message, $headers);

				return view('lost-password', ['socials' => $socials]);
		}
		return view('lost-password', ['socials' => $socials]);
	}

	public function changePassword($link, Request $request) {
		$link;
		$socials = socialDisp();
		return view('change-password', ['socials' => $socials, 'link' => $link]);
		
	}

	public function changeThePassword(Request $request) {
		
    $errorMsg = [];
		$link = Input::get('link');
		$npassword = Input::get('password');
		$cpassword = Input::get('confirm-password');
		$errors = 0;

		if ($npassword !== $cpassword) {
			$errors++;
			echo 'test';
		}
		if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$-.:-?{-~!"^_`\[\]\/])(?=.{8,})/',
			$cpassword)) {
			$errors++;
			echo 'Votre mot de passe doit contenir au moins 8
					caractères, dont une majuscule, une minuscule, un chiffre et un
					symbole.';
		}

		// sanitize and hash new pass
		$npassword = filter_var($npassword);
		$password = password_hash($npassword, PASSWORD_BCRYPT);

			if ($errors === 0) {
				modifyPassword($link, $password);
				return redirect()->to('/')->send();
      }
			else {
				return view('error', ['errors' => $errorMsg]);
			}
		
	}
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
