<?php 
function sanitizeFormPassword($inputText) {
	$inputText = strip_tags($inputText);
	return $inputText;
}

function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}



if(isset($_POST['registerButton'])) {
	//Register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
//GRACE A ÇA ON ECRIT DANS LE INPUT
	
	$firstName = sanitizeFormString($_POST['firstName']);
//GRACE A ÇA ON ECRIT DANS LE INPUT
	$lastName = sanitizeFormString($_POST['lastName']);
//GRACE A ÇA ON ECRIT DANS LE INPUT
	$email = sanitizeFormString($_POST['email']);
//GRACE A ÇA ON ECRIT DANS LE INPUT
	$email2 = sanitizeFormString($_POST['email2']);
//GRACE A ÇA ON ECRIT DANS LE INPUT
	$password = sanitizeFormPassword($_POST['password']);
//GRACE A ÇA ON ECRIT DANS LE INPUT
    $password2 = sanitizeFormPassword($_POST['password2']);
 //GRACE A ÇA ON ECRIT DANS LE INPUT
    $wasSuccessful = $account -> register($username, $firstName,$lastName, $email, $email2, $password, $password2);
if ($wasSuccessful == true) {
    header ("Location: index.php");
}
//SI LE REGISTRE ABOUTIT ALORS REDIRIGER VERS L'INDEX 
}


?>