<?php

include("top.php"); 

include ("db-connect.php"); //kobler til db 
?>


    <h2>Rediger bilde</h2>
    
    <form method="post" action="" id="innlev1" name="innlev1">
        
           <a style="color:black;">Bildenr:</a><select id="bildenr" name="bildenr">
        
        <?php
        
        $sqlSetning = "SELECT bildenr FROM bilde;";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        
        while($rad=mySqli_fetch_array($sqlResultat)){
        
        echo("<option id='bildenr' name='bildenr' value='$rad[bildenr]'>$rad[bildenr]</option>");
            
        }
        
        ?>
        
        </select><br>
           <input type="submit" value="Fortsett" id="fortsett" name="fortsett" alt="fortsett">
           <input type="reset" value="Nullstill" id="nullstill" name="nullstill" alt="nullstill">
    
        
    </form>

    

<?php 

if (isset($_POST["fortsett"])){
    
    $valgtBildenr = $_POST["bildenr"];
    
    $finnBildenr = "SELECT bildenr FROM bilde WHERE bildenr='$valgtBildenr';";
    $sqlBildenr = mysqli_query($db, $finnBildenr) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $bildenr = mySqli_fetch_array($sqlBildenr);
    
    $finnBeskrivelse = "SELECT beskrivelse FROM bilde WHERE bildenr='$valgtBildenr';";
    $sqlBeskrivelse = mysqli_query($db, $finnBeskrivelse) or die ("<b>Error:</b> Ikke mulig å koble til database");
    
    $beskrivelse = mySqli_fetch_array($sqlBeskrivelse);
    
    
    
    echo("
    <br>
    <form method='post' action='' id='endreBilde' name='endreBilde'>
    Bildenr: <input type='text' id='endreBildenr' name='endreBildenr' value='$bildenr[bildenr]' readonly required ><br>
    Beskrivelse: <input type='text' id='endreBeskrivelse' name='endreBeskrivelse' value='$beskrivelse[beskrivelse]' required><br>
    <input type='submit' value='Endre' id='endre' name='endre' alt='endre'>
    <input type='reset' value='Nullstill' id='nullstill' name='nullstill' alt='nullstill'>
    </form>
    
    <div id='melding'></div>
    
    <script src='endreStudent.js'></script>
    ");
    
    }

    if (isset($_POST["endre"])){

    $bildenr=$_POST["endreBildenr"];
    $beskrivelse=$_POST["endreBeskrivelse"];

    if (!$bildenr or !$beskrivelse){
    echo("Alle feltene må fylles ut!");}

    else{   
        
    $sqlUpdate = "UPDATE bilde SET bildenr='$bildenr',beskrivelse='$beskrivelse' WHERE bildenr='$bildenr';";
    mysqli_query($db, $sqlUpdate) or die ("<b>Error:</b> Ikke mulig å endre");
    
    echo("Følgende er registert: <br>
    $bildenr,
    $beskrivelse,
    
    ");
        
    }}
    


include("bot.html"); ?>