<?php
include("includes/classes/Account.php");
include("includes/classes/Constants.php");
$account = new Account();

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");
//IMPORTER
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
//SI LE FORMULAIRE TA RENVOYER LE NOM C'EST QU'IL EXISTE
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <title>Welcome to KahinaStyle</title>
</head>
<body>
  <div id="inputContainer">
<form id="loginForm" action="register.php" method="POST">
<h2>Se connecter à son compte</h2>
<p>
  
    <label for="loginUserName">Pseudo</label>
<input id="loginUserName" name="loginUserName" type="text" placeholder="ex:Rodrigo" required></input>
</p>
<p>
    <label for="loginPassword">Mot de passe</label>
<input id="loginPassword" name="loginPassword" type="password"  required></input>
</p>
<button type="submit" name="loginButton">Se connecter</button>
</form>



<form id="registerForm" action="register.php" method="POST">
<h2>Créer son compte</h2>
<p>
<?php echo $account ->getError(Constants::$usernameCharacters);//RAPPELLE UNE ERREUR?>
    <label for="username">Pseudo</label>
<input id="username" name="username" type="text" placeholder="Pseudo" value="<?php getInputValue('username')?>" required></input>
</p>

<p>
<?php echo $account -> getError(Constants::$firstNameCharacters);//RAPPELLE UNE ERREUR?>
    <label for="firstName">Prénom</label>
<input id="firstName" name="firstName" type="text" placeholder="ex:Rudy" required></input>
</p>

<p>
<?php echo $account -> getError(Constants::$lastNameCharacters);//RAPPELLE UNE ERREUR?>
    <label for="lastName">Nom de famille</label>
<input id="lastName" name="lastName" type="text" placeholder="ex:Gonzales" required></input>
</p>

<p>
<?php echo $account -> getError(Constants::$emailInvalid);//RAPPELLE UNE ERREUR?>
<?php echo $account -> getError(Constants:: $emailDoNotMatch);//RAPPELLE UNE ERREUR?>
    <label for="email">Email</label>
<input id="email" name="email" type="email" placeholder="ex : rudyportuguesh@gmail.com" required></input>
</p>

<p>
  <label for="email2">Confirmer son Email</label>
<input id="email2" name="email2" type="email" placeholder="ex : rudyportuguesh@gmail.com" required></input>
</p>



<p>
<?php echo $account -> getError(Constants::$passwordsNotMatch );//RAPPELLE UNE ERREUR?>
<?php echo $account -> getError(Constants::$passwordsNotAlphanumerique);//RAPPELLE UNE ERREUR?>
<?php echo $account -> getError(Constants::$passwordsCharacters);//RAPPELLE UNE ERREUR?>
    <label for="password">Mot de passe</label>
<input id="password" name="password" type="password" placeholder="mot de passe"  required></input>
</p>
<p>
    <label for="password2">Confirmer le mot de passe</label>
<input id="password2" name="password2" type="password" placeholder="mot de passe" required></input>
</p>

<button type="submit" name="registerButton">Créer le compte</button>
</form>
  </div>  
</body>
</html>