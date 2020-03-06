<?php
//PARLER AVEC LA BDD
ob_start();
session_start();
$timezone = date_default_timezone_set("Europe/London");
 $con = mysqli_connect("localhost", "root","","Formulaire");

if (mysqli_connect_errno()){
    echo "Erreur de connection : ".mysqli_connect_errno();
}
?>