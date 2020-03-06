<?php
 class Account {
//    private $con;
//     private $errorArray;
//      public function __construct($con){
//        $this->con = $con;
//      $this -> errorArray = array();
//      }
   

		public function login($un, $pw) {

			$pw = md5($pw);

      // $query = "SELECT * FROM users WHERE username=".$pw;
      // $res = mysqli_query($this->con, $query);
      // var_dump($res);

       $bddCo = new PDO("mysql:host=localhost;dbname=Formulaire;charset=utf8", "root", "");

      $requete = $bddCo->prepare("SELECT * FROM users WHERE username = :pseudo");
      $requete->execute(array(
                "pseudo" => $un
            ));

			// if(mysqli_num_rows($res) == 1) {
			// 	return true;
			// }
			// else {
			// 	array_push($this->errorArray, Constants::$loginFailed);
			// 	return false;
      // }
      
      $resultat = $requete->fetch();

      if($resultat) {
        if($resultat['password'] === $pw) {
          header("Location: index.php");
        }
      }

		}
//PARAMETRE DE CONNEXION A SON COMPTE SI IL ATTEINT BIEN LA BDD SINON RETOUR D'ERREUR 
    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2){
        $this -> validateUserName($un);
        $this -> validateFirstName($fn);
        $this -> validateLastName($ln);
        $this -> validateEmails($em, $em2);
        $this -> validatePasswords($pw, $pw2);
        if(empty($this -> errorArray) == true){
          return $this ->insertUserDetails($un, $fn, $ln, $em, $pw);
            //INSERER DANS LA BASE DE DONEES 
        }
        else {
          return false;  
        }
        //SI UNE DES CONDITIONS N'EST PAS VALIDÉ
    }
     public function getError($error){
       if(!in_array($error, $this->errorArray)){
         $error = "";
      }
      return "<span class='Message d'erreur'>$error</span>";
    //  // SI IL NE TROUVE PAS LA PHRASE CA AFFICHE UNE ERREUR   
      
     }
    private function insertUserDetails($un, $fn, $ln, $em, $pw){
    $encryptedPw = md5($pw);
    //POUR CACHER LE MOT DE PASSE
    $profilePic = "assets/images/profile-pic/profil.jpg";
    $date = date("Y-m-d");
    

     $result = mysqli_query($this->con, "INSERT INTO users VALUES (0, '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

    // donner la valeur 0 à l'id car il doit etre un entier 
    //mysqli_query retourne vrai ou faux en fonction de si ca fonctionne ou pas 
 return $result;
     }
    private function validateUserName($un){
      if((strlen($un)) > 25 || strlen($un) < 5 ){
          array_push($this ->errorArray, Constants::$usernameCharacters );
          return; 
      } 

     
       $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
       if(mysqli_num_rows($checkUsernameQuery)!= 0){
          array_push($this->errorArray, Constants::$usernameTaken);
         return;
       }
      }
   
   
    //LE PSEUDO DOIT CONTENIR ENTRE 5 ET 25 LETTRES ET VÉRIFIER QU'IL N'EXISTE PAS
    private function validateFirstName($fn){
        if((strlen($fn)) > 25 || strlen($fn) < 2 ){
            array_push($this ->errorArray, Constants::$firstNameCharacters );
            return; 
        } 
    }
      //LE PRENOM DOIT CONTENIR ENTRE 2 ET 25 LETTRES ET VÉRIFIER QU'IL N'EXISTE PAS
    private function validateLastName($ln){
        if((strlen($ln)) > 25 || strlen($ln) < 2 ){
            array_push($this ->errorArray,Constants:: $lastNameCharacters );
            return; 
        } 
    }
      //LE NOM DOIT CONTENIR ENTRE 2 ET 25 LETTRES ET VÉRIFIER QU'IL N'EXISTE PAS
    private function validateEmails($em, $em2){
        if($em != $em2){
            array_push($this ->errorArray,Constants:: $emailInvalid);
            return;
        }
     if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
        array_push($this -> errorArray,Constants::$emailDoNotMatch );
        return;
     }
     //VERIFIER QUE L'EMAIL N'EST PAS UTILISER PAR QUELQU'UN D'AUTRE 
     $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
     if(mysqli_num_rows($checkEmailQuery) != 0){
       array_push($this->errorArray, Constants::$emailTaken);
       return;
     } 
    }
    
      //L'EMAIL CORRESPOND T-IL ?
    private function validatePasswords($pw, $pw2){
    if($pw != $pw2){
        array_push($this -> errorArray,Constants::$passwordsNotMatch );
        return;
    }
    //VERIFIER QUE LES 2 MOT DE PASSE CORRESPONDENT
    if(preg_match('/[^A-Za-z0-9]/', $pw)) {
      array_push($this -> errorArray,Constants::$passwordsNotAlphanumerique );
      return;
    } 
    //CE QUE PEUT CONTENIR LE MOT DE PASSE
    if((strlen($pw)) > 30 || strlen($pw) < 5 ){
        array_push($this ->errorArray, Constants::$passwordsCharacters );
        return; 
    } 
//LE MOT DE PASSE DOIT CONTENIR ENTRE 5 ET 30 LETTRES 
  }
}   
        
    

?>