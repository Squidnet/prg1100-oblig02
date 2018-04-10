<?php

include("top.php");

?> <h2>Vis alle bilder</h2>
    
    <form method="post" action="" id="innlev1" name="innlev1">
        
        
        
    </form>

<?php

include ("db-connect.php"); //kobler til db
    
$sqlSetning = "SELECT * FROM bilde ORDER BY bildenr";
$sqlResultat = mysqli_query($db, $sqlSetning) or die ("<b>Error:</b> Ikke mulig å koble til database");
$antallRader = mysqli_num_rows($sqlResultat);

echo("<table>");
    
    echo("<tr><td><b>bildenr</b></td><td></td><td><b>opplastingsdato</b></td><td></td><td><b>filnavn</b></td><td></td><td><b>beskrivelse</b></td><td></td><td><b>bilde</b></tr>");
    
while($rad=mySqli_fetch_array($sqlResultat)){
    
    
    echo("<tr><td> $rad[bildenr]</td><td></td> <td> $rad[opplastingsdato]</td><td></td> <td> $rad[filnavn]</td><td></td> <td> $rad[beskrivelse]</td><td></td> <td><img style='max-width:100px;max-height:200px;' src='../../raw/". @$rad[filnavn] . "'></td></tr>"); //asdasd
    
}
    


echo("</table>");

include("bot.html");
    
?>