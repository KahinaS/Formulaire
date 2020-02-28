<?php
class Account {
   private $errorArray;
    public function __construct(){
    $this -> errorArray = array();
    }
    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2){
        $this -> validateUserName($un);
        $this -> validateFirstName($fn);
        $this -> validateLastName($ln);
        $this -> validateEmails($em, $em2);
        $this -> validatePasswords($pw, $pw2);
        if(empty($this -> errorArray) == true){
          return true;
            //INSERER DANS LA BASE DE DONEES 
        }
        else {
          return false;  
        }
        //SI UNE DES CONDITIONS N'EST PAS VALIDÉ
    }
    public function getError($error){
        if(!in_array($error, $this->errorArray))
        $error =""; {
            return "<span class='errorMessage'>$error</span>";
        }
    }
    private function validateUserName($un){
      if((strlen($un)) > 25 || strlen($un) < 5 ){
          array_push($this ->errorArray, Constants::$usernameCharacters );
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