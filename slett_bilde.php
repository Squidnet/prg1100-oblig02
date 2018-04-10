<?php

include("top.php"); 

include ("db-connect.php"); //kobler til db 

?>

<script src="funksjon.js"></script>


    <h2>Slett bilde</h2>
    
    <form method="post" action="" id="innlev1" name="innlev1" onSubmit="return bekreft()">
        
           <a style="color:black;">Bilde:</a><select id="bildenr" name="bildenr">
        
        <?php
        
        $sqlSetning = "SELECT bildenr FROM bilde;";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        
        while($rad=mySqli_fetch_array($sqlResultat)){
        
        echo("<option id='valgtFil' name='valgtFil' value='$rad[bildenr]'>$rad[bildenr]</option>");
            
        }
        
        ?>
        
        </select><br>
           <input type="submit" value="Slett" id="fortsett" name="fortsett" alt="fortsett">
           <input type="reset" value="Nullstill" id="nullstill" name="nullstill" alt="nullstill">
    
        
    </form>

    

<?php 

if (isset($_POST["fortsett"])){
    
    $valgtFilnavn = $_POST["bildenr"];

    $sqlSetning = "SELECT * FROM student WHERE bildenr='$valgtFilnavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        $antallRader = mysqli_num_rows($sqlResultat);
    
    $finnFilnavn = "SELECT filnavn FROM bilde WHERE bildenr='$valgtFilnavn';";
    $sqlFilnavn = mysqli_query($db, $finnFilnavn) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $filnavn = mySqli_fetch_array($sqlFilnavn);
    @$filnavn2= $filnavn[filnavn];
        
        if($antallRader!=0){ //sjekker om den finnes fra før
            echo("Bilde er allerede registrert hos student!");
        }
    
    else {
    
    $slettFraDB = "DELETE FROM bilde WHERE bildenr='$valgtFilnavn';";
    mysqli_query($db, $slettFraDB) or die ("<b>Error:</b> Kan ikke slette.");
    
    $bildefil = "../../raw/".$filnavn2;
    unlink($bildefil) or die ("Kan ikke slettet bilde på server");
    
    echo("$valgtFilnavn ble slettet");
    }}
      

include("bot.html"); ?>