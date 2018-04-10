<?php

include("top.php"); 

include ("db-connect.php"); //kobler til db 
?>


    <h2>Rediger student</h2>
    
    <form method="post" action="" id="innlev1" name="innlev1">
        
           <a style="color:black;">Brukernavn:</a><select id="brukernavn" name="brukernavn">
        
        <?php
        
        $sqlSetning = "SELECT brukernavn FROM student;";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        
        while($rad=mySqli_fetch_array($sqlResultat)){
        
        echo("<option value='$rad[brukernavn]'>$rad[brukernavn]</option>");
            
        }
        
        ?>
        
        </select><br>
           <input type="submit" value="Fortsett" id="fortsett" name="fortsett" alt="fortsett">
           <input type="reset" value="Nullstill" id="nullstill" name="nullstill" alt="nullstill">
    
        
    </form>

    

<?php 

if (isset($_POST["fortsett"])){
    
    $valgtStudent = $_POST["brukernavn"];
    
    $finnFornavn = "SELECT fornavn FROM student WHERE brukernavn='$valgtStudent';";
    $sqlFornavn = mysqli_query($db, $finnFornavn) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $fornavn = mySqli_fetch_array($sqlFornavn);
    
    $finnEtternavn = "SELECT etternavn FROM student WHERE brukernavn='$valgtStudent';";
    $sqlEtternavn = mysqli_query($db, $finnEtternavn) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $etternavn = mySqli_fetch_array($sqlEtternavn);
    
    $finnKlassekode = "SELECT klassekode FROM student WHERE brukernavn='$valgtStudent';";
    $sqlKlassekode = mysqli_query($db, $finnKlassekode) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $klassekode = mySqli_fetch_array($sqlKlassekode);
    
    $finnLevfrist = "SELECT nesteLeveringsfrist FROM student WHERE brukernavn='$valgtStudent';";
    $sqlLevfrist = mysqli_query($db, $finnLevfrist) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $levFrist = mySqli_fetch_array($sqlLevfrist);
    
    $finnBildenr = "SELECT bildenr FROM student WHERE brukernavn='$valgtStudent';";
    $sqlBildenr = mysqli_query($db, $finnBildenr) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $bildenr = mySqli_fetch_array($sqlBildenr);
    
    echo("
    <br>
    <form method='post' action='' id='endreKlasse' name='endreKlasse'>
    Brukernavn: <input type='text' id='endreBrukernavn' name='endreBrukernavn' value='$valgtStudent' readonly required ><br>
    Fornavn: <input type='text' id='endreFornavn' name='endreFornavn' value='$fornavn[fornavn]' required><br>
    Etternavn: <input type='text' id='endreEtternavn' name='endreEtternavn' value='$etternavn[etternavn]' required><br>
    Klassekode: <select id='klassekode' name='klassekode'><option selected>$klassekode[klassekode]</option>'");
        
        
        
        $sqlSetning = "SELECT klassekode FROM klasse;";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        
        while($rad=mySqli_fetch_array($sqlResultat)){
        
        echo("<option value='$rad[klassekode]'>$rad[klassekode]</option>");
            
        }
        
  
        
    echo("</select><br>
    Leveringsfrist: <input type='text' id='datepicker' name='endreLevFrist' value='$levFrist[nesteLeveringsfrist]' required readonly><br>
    Bildenr: <select id='endreBildenr' name='endreBildenr'><option selected>$bildenr[bildenr]</option>'");
        
        
        
        $sqlSetning = "SELECT bildenr FROM bilde;";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        
        while($rad=mySqli_fetch_array($sqlResultat)){
        
        echo("<option value='$rad[bildenr]'>$rad[bildenr]</option>");
            
        }
        
  
        
    echo("</select><br>
    <input type='submit' value='Endre' id='endre' name='endre' alt='endre'>
    <input type='reset' value='Nullstill' id='nullstill' name='nullstill' alt='nullstill'>
    </form>
    
    <div id='melding'></div>
    
    <script src='endreStudent.js'></script>
    ");
    
    }

    if (isset($_POST["endre"])){

    $brukernavn=$_POST["endreBrukernavn"];
    $fornavn=$_POST["endreFornavn"];
    $etternavn=$_POST["endreEtternavn"];
    $klassekode=$_POST["klassekode"];
    $levFrist = $_POST["endreLevFrist"];
    $bildenr = $_POST["endreBildenr"];

    if (!$brukernavn or !$fornavn or !$etternavn or !$klassekode or !$levFrist or !$bildenr){
    echo("Alle feltene må fylles ut!");}

    else{   
    
    $brukernavn = $_POST["endreBrukernavn"];
    $fornavn = $_POST["endreFornavn"];
    $etternavn = $_POST["endreEtternavn"];
    $klassekode = $_POST["klassekode"];
    $levFrist = $_POST["endreLevFrist"];
    $bildenr = $_POST["endreBildenr"];
        
    $sqlUpdate = "UPDATE student SET fornavn='$fornavn',etternavn='$etternavn',klassekode='$klassekode', nesteLeveringsfrist='$levFrist', bildenr='$bildenr' WHERE brukernavn='$brukernavn';";
    mysqli_query($db, $sqlUpdate) or die ("<b>Error:</b> Ikke mulig å endre");
    
    echo("Følgende er registert: <br>
    $brukernavn,
    $fornavn,
    $etternavn,
    $klassekode,
    $levFrist,
    $bildenr
    
    ");
        
    }}
    


include("bot.html"); ?>