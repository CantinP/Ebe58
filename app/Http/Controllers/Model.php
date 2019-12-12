<?php

function viewPartner(){
  $sql = "SELECT DISTINCT id, name, link, logo, description FROM ebe58_partner";
  $result =\DB::select($sql);

  return $result;
}

function profil($token){
  $sql = "SELECT DISTINCT id, name, avatar, email FROM users WHERE password = '$token'";
  $result =\DB::select($sql);

  if (!empty($result)) {
    $id = $result[0]->id;
    $name = $result[0]->name;
    $avatar = $result[0]->avatar;
    $mail = $result[0]->email;

    return ['id' => $id, 'name' => $name, 'avatar' => $avatar, 'email' => $mail];
  }
}

function partnerView($id){
  $sql = "SELECT DISTINCT * FROM ebe58_partner WHERE id = '$id'";
  $result =\DB::select($sql)[0];

  return $result;
}

function addPartner($name, $link, $img_name, $text){
  $sql = "INSERT INTO ebe58_partner (name, link, logo, description) VALUES ('$name', '$link', '$img_name', '$text')";
  \DB::insert($sql);
}

function partnerUpdate($name, $link, $img_name, $description, $id){
  $sql = "UPDATE ebe58_partner SET name = '$name', link = '$link', logo = '$img_name', description = '$description' WHERE id = '$id'";
  \DB::update($sql);
}

function partnerDelete($id){
  $sql = "DELETE FROM ebe58_partner WHERE id = '$id'";
  \DB::delete($sql);
}

function getTexts($page) {

	//get texts of current page
	$sql = "SELECT text FROM ebe58_texts WHERE page = '$page'";
	$result = \DB::select($sql);

	$list = [];
	for ($i = 0; $i < count($result); $i++) {
		array_push($list, $result[$i]->text);
	}
	return $list;
}

function displayTexts($page){
  $sql = "SELECT id, text FROM ebe58_texts WHERE page = '$page'";
	$result = \DB::select($sql);

  return $result;
}

function updateText($text, $id){
  $sql = "UPDATE ebe58_texts SET text = '$text' WHERE id = '$id'";
  \DB::update($sql);
}

function activity(){
  $sql = "SELECT * FROM ebe58_services";
  $result =\DB::select($sql);

  return $result;
}

function activityDisplay($id){
  $sql = "SELECT * FROM ebe58_services WHERE id = '$id'";
  $result =\DB::select($sql)[0];

  return $result;
}

function activityId(){
  $sql = "SELECT DISTINCT id FROM ebe58_services";
  $result =\DB::select($sql);
  if(!empty($result)){
  foreach($result as $resulting){
    $id = $resulting -> id;
    $product = $resulting -> product;
  }
  return ['id' => $id];
  }else{
    $id = "";
    $product = "0";
  return ['id' => $id];
  }
}

function activityView($id){
  $sql = "SELECT DISTINCT id, name, link, banner, text, text2, text3, text4, video, color, pdf, button, logo FROM ebe58_services WHERE id = '$id'";
  $result =\DB::select($sql)[0];

  return $result;
}

function addActivity($name, $link, $img_name, $text, $text2, $text3, $text4, $video, $color, $pdf_name, $logo_name, $btn_name){
  $sql = "INSERT INTO ebe58_services (name, link, banner, text, text2, text3, text4, video, color, pdf, button, logo) VALUES ('$name', '$link', '$img_name', '$text', '$text2', '$text3' ,'$text4', '$video', '$color', '$pdf_name', '$btn_name', '$logo_name')";
  \DB::insert($sql);
}

function activityUpdate($name, $link, $img_name, $text, $text2, $text3, $text4, $video, $color, $id, $pdf_name, $logo_name, $btn_name){
  $sql = "UPDATE ebe58_services SET name = '$name', link = '$link', banner = '$img_name', text = '$text', text2 = '$text2', text3 = '$text3', text4 = '$text4', video = '$video', color = '$color', pdf = '$pdf_name', logo = '$logo_name', button = '$btn_name' WHERE id = '$id'";
  \DB::update($sql);
}

function activityDelete($id){
  $sql = "DELETE FROM ebe58_services WHERE id = '$id'";
  \DB::delete($sql);
}

function informations($password, $type) {

  $sql = "SELECT id, name, email FROM users WHERE password = '$password'";
  $result =\DB::select($sql);

  $id = $result[0]->id;
  $name = $result[0]->name;
  $email = $result[0]->email;

	if (Auth::user() && Auth::user()->rank === 0) {
		$sql = "SELECT  address, zip, city FROM ebe58_client WHERE id_users = '$id'";
		$result =\DB::select($sql);
    if(!empty($result)){
		$address = $result[0]->address;
		$zip = $result[0]->zip;
		$city = $result[0]->city;

		return ['name' => $name, 'email' => $email, 'address' => $address, 'zip' => $zip, 'city' => $city];
    }
    else{
      return ['name' => $name, 'email' => $email];
    }
	}
	if (Auth::user() && Auth::user()->rank === 1) {
		$sql = "SELECT service FROM ebe58_team WHERE id_users = '$id'";
		$result =\DB::select($sql);
    if(!empty($result)){

		$service = $result[0]->service;

		return ['name' => $name, 'email' => $email, 'service' => $service];
    }
    else{
      return ['name' => $name, 'email' => $email];
    }
	}

	return ['name' => $name, 'email' => $email];
}

function infoUpdate($name, $oldEmail, $email, $address, $zip, $city, $service){

	if (Auth::user() && Auth::user()->rank === 1) {
		$sql = "UPDATE ebe58_team SET service = '$service' WHERE id_users ='$id' ";
		\DB::update($sql);
	}

	if (Auth::user() && Auth::user()->rank === 0) {
		$sql = "UPDATE ebe58_client SET address = '$address', zip = '$zip', city = '$city' WHERE id_users ='$id'";
		\DB::update($sql);
	}

	$sql = "UPDATE users SET name = '$name', email = '$email' WHERE email = '$oldEmail'";
	\DB::update($sql);
}

function exist($mail) {
  $sql = "SELECT email FROM users WHERE email = '$mail'";
	$result = \DB::select($sql);
	return (!empty($result));
}

function verifyPassword($email) {
	$sql = "SELECT password FROM users WHERE users.email = '$email'";
	$result = \DB::select($sql);

	$rPassword = $result[0]->password;
	return $rPassword;
}

function socialModify($id){
  $sql = "SELECT * FROM ebe58_social WHERE id = '$id'";
  $result =\DB::select($sql)[0];

  return $result;
}

function socialUp($id, $name, $remember, $link){
  $sql = "UPDATE ebe58_social SET name = '$name', link = '$link', logo = '$remember' WHERE id = '$id'";
  \DB::update($sql);
}

function deleteSocial($id){
  $sql = "DELETE FROM ebe58_social WHERE id = '$id'";
  \DB::delete($sql);
}

function createSocial($name, $remember, $link){
  $sql = "INSERT INTO ebe58_social (name, link, logo) VALUES ('$name', '$link', '$remember')";
  \DB::insert($sql);
}

function socialDisp(){
  $sql = "SELECT * FROM ebe58_social";
  $result =\DB::select($sql);

  return $result;
}

function createNews($title, $text, $image, $id_users, $link){
  $sql = "INSERT INTO ebe58_news (title, text, image, id_users, link) VALUES ('$title', '$text', '$image', '$id_users', '$link')";
  \DB::insert($sql);
}

function updateNews($id, $title, $text, $img_name, $prio, $link){
  $sql = "UPDATE ebe58_news SET title = '$title', text = '$text', image = '$img_name', prio = '$prio', link = '$link' WHERE id = '$id'";
  \DB::update($sql);
}

function deleteNews($id){
  $sql = "DELETE FROM ebe58_news WHERE id = '$id'";
  \DB::delete($sql);
}

function displayNews(){
  $sql = "SELECT * FROM ebe58_news";
  $result =\DB::select($sql);

  return $result;
}

function displayNewsHome(){
  $sql = "SELECT * FROM ebe58_news ORDER BY id DESC LIMIT 5";
  $result =\DB::select($sql);

  return $result;
}

function uniqueNews($id){
  $sql = "SELECT * FROM ebe58_news WHERE id = '$id'";
  $result =\DB::select($sql)[0];

  return $result;
}


////part of anaïs
//
////This function allow to add a product into the database
//
//function productCreate($product_name, $product_description, $product_price, $product_height, $product_weight, $product_quantity, $product_width, $activities, $img_name){
//    $sql = "INSERT INTO ebe58_produit VALUES (NULL, '$product_name', '$product_description', '$product_price', '$product_height', '$product_weight','$product_quantity','$product_width', '$activities', '$img_name')";
//    \DB::insert($sql);
//}
//
////This function allows to update the information on a product.
//
//function productUpdate($id, $product_name, $product_description, $product_price, $product_height, $product_weight, $product_quantity, $product_width, $activities, $img_name){
//    $sql = "UPDATE ebe58_produit SET name = '$product_name', description = '$product_description', price = '$product_price', quantity = '$product_quantity', weight = '$product_weight', height = '$product_height', width = '$product_width', image = '$img_name' WHERE id = '$id'";
//    \DB::update($sql);
//}
//
//function productDelete($id){
//    $sql = "DELETE FROM ebe58_produit WHERE id = '$id'";
//    \DB::delete($sql);
//}
//
////This function allows to show product
//
//function showProduct($activity){
//    $sql = "SELECT DISTINCT id, name, description, price, height, weight, quantity, width, image FROM ebe58_produit WHERE activity = '$activity'";
//    $result = \DB::select($sql);
//
//    return $result;
//}
//
////This function allow to show all the products.
//
//function showAllProduct(){
//    $sql = "SELECT DISTINCT id, name, description, price, height, weight, quantity, width, image FROM ebe58_produit";
//    $result = \DB::select($sql)[0];
//    return $result;
//}
//
////This function allows to show only one product according its category.
//
//function showOneProduct($id){
//    $sql = "SELECT DISTINCT id, name, description, price, height, weight, quantity, width, image FROM ebe58_produit WHERE id = '$id'";
//    $result = \DB::select($sql);
//    return $result;
//}

function section(){
    $sql = "SELECT DISTINCT * FROM ebe58_services";
    $result =\DB::select($sql);
    return $result;
}

function sectionExist($activity){
    $sql ="SELECT id FROM ebe58_services WHERE id = '$activity'";
    $result =\DB::select($sql);
    return $result;
}

function adminDisp(){
  $sql = "SELECT id, name, rank FROM users";
  $result =\DB::select($sql);

  return $result;
}

function adminModify($id){
  $sql = "SELECT * FROM users WHERE id = '$id'";
  $result =\DB::select($sql)[0];

  return $result;
}

function adminUp($id, $rank){
  $sql = "UPDATE users SET rank = '$rank' WHERE id = '$id'";
  \DB::update($sql);
}

function deleteAdmin($id){
  $sql = "DELETE FROM users WHERE id = '$id'";
  \DB::delete($sql);
}

function profilNews($id_user){
  $sql = "SELECT DISTINCT id, name, avatar, email FROM users WHERE id = '$id_user'";
  $result =\DB::select($sql);

  if (!empty($result)) {
    $id = $result[0]->id;
    $name = $result[0]->name;
    $avatar = $result[0]->avatar;
    $mail = $result[0]->email;

    return ['id' => $id, 'name' => $name, 'avatar' => $avatar, 'email' => $mail];
  }
}

function recoverPassByMail($mail, $link) {
	$sql = "SELECT id FROM users WHERE email = '$mail'";
  $result = \DB::select($sql);
	if (empty($result))
		return false;

	$sql = "UPDATE users SET link = '$link' WHERE email = '$mail'";
	\DB::update($sql);

	return true;
}

function testLink($link) {
	$sql = "SELECT link FROM users WHERE link = '$link'";
	$result = \DB::select($sql);

	return $result;  //prevent user from use the overwriting link '0'
}

function modifyPsw($email, $cpassword){

	$sql = "UPDATE users SET password = '$cpassword' WHERE email = '$email'";
	\DB::update($sql);
}

function modifyPassword($link, $password) {

	// replace lost password by the new one
	$sql = "UPDATE users SET password = '$password' WHERE link = '$link'";
	\DB::update($sql);

	//overwrite link
	$sql = "UPDATE users SET link = '0' WHERE link = '$link'";
	\DB::update($sql);
}

function addText($page, $text){
  $sql = "INSERT INTO ebe58_texts (text, page) VALUES ('$text', '$page')";
  \DB::insert($sql);
}

function textDelete($id){
  $sql = "DELETE FROM ebe58_texts WHERE id = '$id'";
  \DB::delete($sql);
}
