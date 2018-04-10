<?php
include ("db-connect.php"); //kobler til db
session_start();
?>

<!-- PRG1000 OBLIG 02 -->
<!doctype html>
<html lang="no">

    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="stilark.css">
    <title>PRG1100 | OBLIG 02</title>
    </head>
    
    <body>
    
        <header>
            <b>PRG1100 | OBLIG 02</b>
        </header>
        
        <nav>
  
        </nav>
    
        <article>


<h2>Registrer</h2>

<a style="color:black;">Her kan du opprette en ny bruker.</a><br><br>

 <form method="post" action="" id="innlev1" name="innlev1">
        
           <a style="color:black;">Brukernavn:</a><input type="text" id="brukernavn" name="brukernavn" required><br>
           <a style="color:black;">Fornavn:</a><input type="text" id="fornavn" name="fornavn" required><br>
           <a style="color:black;">Etternavn:</a><input type="text" id="etternavn" name="etternavn" required><br>
           <a style="color:black;">Passord:</a><input type="password" id="passord" name="passord" required><br>
           <input type="submit" value="Registrer" id="fortsett" name="fortsett" alt="fortsett">
           <input type="reset" value="Nullstill" id="nullstill" name="nullstill" alt="nullstill">&emsp;
           <a href="https://home.usn.no/216799/prg1100/innlevering2/index.php"><input type="button" value="Logg inn" id="logginn" name="logginn" alt="logginn"></a>
        
    </form>

<?php

if (isset($_POST["fortsett"])){

$brukernavn=$_POST["brukernavn"];
$fornavn=$_POST["fornavn"];
$etternavn=$_POST["etternavn"];
$passord=$_POST["passord"];
$passord=password_hash($passord, PASSWORD_DEFAULT);

if (!$brukernavn or !$fornavn or !$etternavn or !$passord){
    echo("Alle feltene må fylles ut!");}

else{   
    
    $sqlSetning = "SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
    $antallRader = mysqli_num_rows($sqlResultat);
    
    if ($antallRader!=0){ //sjekk om bruker er registert fra før
        echo("Bruker er allerede registrert");
    }
    
    else {
        $sqlSetning = "INSERT INTO bruker (brukernavn, fornavn, etternavn, passord) VALUES ('$brukernavn', '$fornavn', '$etternavn', '$passord');";
        mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> ikke mulig å registere data i databasen");
        
        echo("$brukernavn, $fornavn, $etternavn, er registert");
    }
}
}
include("bot.html");
        
?>