<?php

include("top.php"); ?>

<h2>Registering av bilde</h2>

<script src="klasse_valid.js"></script>
    
    <form method="post" action="" id="innlev1" name="innlev1" enctype="multipart/form-data">
        
           <a style="color:black;">Velg bilde:</a><input type="file" id="fil" name="fil" size="60" required><br>
           <a style="color:black;">Bildenr:</a><input type="number" id="bildenr" name="bildenr" required><br><br>
        <a style="color:black;">Beskrivelse:</a><br><textarea style="width:200px;height:100px;" id="beskrivelse" name="beskrivelse" required></textarea><br>
           <input type="submit" value="Fortsett" id="fortsett" name="fortsett" alt="fortsett">
           <input type="reset" value="Nullstill" id="nullstill" name="nullstill" alt="nullstill">
        
    </form>

<div id="melding"></div>

    <script src="klasse_validering.js"></script>



<?php

if (isset($_POST["fortsett"])){
    
$bildenr=$_POST["bildenr"];
$beskriv=$_POST["beskrivelse"];
$filnavn=$_FILES["fil"]["name"];
$filtype=$_FILES["fil"]["type"];
$filsize=$_FILES["fil"]["size"];
$filtmp=$_FILES["fil"]["tmp_name"];
$nyttnavn="../../raw/".$filnavn;
$dato=date("Y-m-d");
    
if (!$bildenr or !$beskriv or !$filnavn){
    echo("Alle feltene må fylles ut!");}
    
else {
    
    if ($filtype!="image/gif" && $filtype!="image/jpeg" && $filtype!="image/jpg" && $filtype!="image/png"){
        die("Det er bare mulig å laste opp bilde filer"); 
    }
    
    if ($filsize > 5000000){
        die("<br>Bilde overstiger 50MB");
    }
        include("db-connect.php");
        $sqlSetning = "SELECT * FROM bilde WHERE filnavn='$filnavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        $antallRader = mysqli_num_rows($sqlResultat);
    
       if($antallRader!=0){ //sjekker om den finnes fra før
            die("Filnavn er allerede registrert!");}
    
    else {
        
        $sqlSetning = "SELECT * FROM bilde WHERE bildenr='$bildenr';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        $antallRader = mysqli_num_rows($sqlResultat);
        
        if($antallRader!=0){ //sjekker om den finnes fra før
            echo("Bilde er allerede registrert!");
        }
        else {
            if (move_uploaded_file($filtmp,$nyttnavn)){
            
            $sqlSetning = "INSERT INTO bilde (bildenr, opplastingsdato, filnavn, beskrivelse) VALUES ('$bildenr','$dato','$filnavn','$beskriv');";
            $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
            
            echo("Bilde er lastet opp");
            }
            else {
                echo("Bilde ble ikke lastet opp");
            }
            
        }
    }
}
    
}


include("bot.html");
        
?>