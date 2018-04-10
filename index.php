<?php
    include("db-connect.php");
    session_start();
    //session_start();//må ligge i toppen av hver side
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

<h2>Logg inn</h2>

<a style="color:black;">Du må logge inn for å få tilgang til funksjonene i denne oppgaven.</a><br><br>

 <form method="post" action="" id="innlev1" name="innlev1">
        
           <a style="color:black;">Brukernavn:</a><input type="text" id="brukernavn" name="brukernavn" required><br>
           <a style="color:black;">Passord:</a><input type="password" id="passord" name="passord" required><br>
           <input type="submit" value="Logg inn" id="fortsett" name="fortsett" alt="fortsett">
           <input type="reset" value="Nullstill" id="nullstill" name="nullstill" alt="nullstill">&emsp;
           <a href="https://home.usn.no/216799/prg1100/innlevering2/registrer.php"><input type="button" value="Registrer" id="registrer" name="registrer" alt="registrer"></a>
        
    </form>

<div id="melding"></div>
    
<?php



if (isset($_POST["fortsett"])){
        
    if(!$_POST["brukernavn"] and !$_POST["passord"]){
        echo("Du må fylle ut begge feltene!");
    }else {
        $brukernavn = $_POST["brukernavn"];
        $passord = $_POST["passord"];
        
        $query = "SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $query) or die ("<b>Error:</b> Ikke mulig å koble til database");
        $antallRader = mysqli_num_rows($sqlResultat);
        
        $rad=mysqli_fetch_array($sqlResultat);
        
        if($antallRader>0){
            if(password_verify($passord,$rad[3])){
                $_SESSION["brukernavn"]=$brukernavn;
                $_SESSION["fornavn"]=$rad[1];
                $_SESSION["etternavn"]=$rad[2];
                $_SESSION["login"]=true;
                
                header("location:reg_klasse.php");
                
            }else{
                echo("Passordet er ikke riktig");
            }
            
        }else{
            echo("Bruker eksisterer ikke");
        }
        
        
    }
    
    
}
    
include("bot.html");
        
?>