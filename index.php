<?php 
include("includes/config.php");
if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = $_SESSION['userLoggedIn'];
}
else{
   (header("Location : register.php"));
}
?>

<html>
<head>
    <meta charset="UTF-8">
   <title>Welcome to KahinaStyle</title>
</head>
<body>
    <p>hello</p>
</body>
</html>