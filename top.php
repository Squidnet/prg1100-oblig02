<?php session_start(); 

if(!$_SESSION["login"]){
    header("location: index.php");
}

?>

<!-- PRG1000 OBLIG 02 -->
<!doctype html>
<html lang="no">

    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="stilark.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: "yy-mm-dd"
    });
  } );
  </script>
    <title>PRG1100 | OBLIG 02</title>
    </head>
    
    <body>
    
        <header>
            <b>PRG1100 | OBLIG 02</b>
            <loginfo>
            <?php 
            if($_SESSION["login"]==true){
                echo("<a>Logget inn: ".$_SESSION['fornavn']." ". $_SESSION['etternavn'] ." </a>");
            } 
            ?>
                &emsp;
            <a href="loggut.php">Logg ut</a>
                </loginfo>
        </header>
        
        <nav>
        <p><b>Registering:</b></p>
        <p class="meny"><a href="reg_klasse.php">| Register klasse</a></p>
        <p class="meny"><a href="reg_student.php">| Register student</a></p>
        <p class="meny"><a href="reg_bilde.php">| Register bilde</a></p>
        <p><b>Vis:</b></p>
        <p class="meny"><a href="vis_klasse.php">| Vis alle klasser</a></p>
        <p class="meny"><a href="vis_student.php">| Vis alle studenter</a></p>
        <p class="meny"><a href="vis_bilder.php">| Vis alle bilder</a></p>
        <p class="meny"><a href="vis_klasseliste.php">| Vis klasseliste</a></p>
        <p><b>Rediger:</b></p>
        <p class="meny"><a href="rediger_klasse.php">| Rediger klasse</a></p>
        <p class="meny"><a href="rediger_student.php">| Rediger student</a></p>
        <p class="meny"><a href="rediger_bilde.php">| Rediger bilde</a></p>
        <p><b>Slett:</b></p>
        <p class="meny"><a href="slett_klasse.php">| Slett klasse</a></p>
        <p class="meny"><a href="slett_student.php">| Slett student</a></p>
        <p class="meny"><a href="slett_bilde.php">| Slett bilde</a></p>
        <p><b>Søk:</b></p>
        <p class="meny"><a href="sook.php">| Søk</a></p>
        </nav>
    
        <article>