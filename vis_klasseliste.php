<?php

include("top.php"); 

include ("db-connect.php"); //kobler til db 
?>


    <h2>Vis klasseliste</h2>
    
    <form method="post" action="" id="innlev1" name="innlev1">
        
           <a style="color:black;">Klasse:</a><select id="klassekode" name="klassekode">
        
        <?php
        
        $sqlSetning = "SELECT klassekode FROM klasse;";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
        
        while($rad=mySqli_fetch_array($sqlResultat)){
        
        echo("<option id='klassekode' name='klassekode' value='$rad[klassekode]'>$rad[klassekode]</option>");
            
        }
        
        ?>
        
        </select><br>
           <input type="submit" value="Fortsett" id="fortsett" name="fortsett" alt="fortsett">
           <input type="reset" value="Nullstill" id="nullstill" name="nullstill" alt="nullstill">
    
        
    </form>

    

<?php 

if (isset($_POST["fortsett"])){
    
    $valgtKlassekode = $_POST["klassekode"];
    
    $sqlSetning = "SELECT student.fornavn, etternavn, bilde.filnavn FROM student INNER JOIN bilde ON student.bildenr=bilde.bildenr WHERE student.klassekode='$valgtKlassekode'";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
    $antallRader = mysqli_num_rows($sqlResultat);

echo("<table>");
    
    echo("<tr><td><b>Fornavn</b></td><td></td><td><b>Etternavn</b></td><td></td><td><b>Bilde</b></td></tr>");
    
while($rad=mySqli_fetch_array($sqlResultat)){
      
    echo("<tr><td> $rad[fornavn]</td><td></td> <td> $rad[etternavn]</td><td></td><td><img style='max-width:100px;max-height:200px;' src='../../raw/". @$rad[filnavn] . "'></td></tr>"); //asdasd
    
}
    


echo("</table>");
}


include("bot.html"); ?>