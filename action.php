<?php
session_start();
include "db.php";

if(isset($_POST["getGericht"])){

    $gericht_query = "SELECT gericht_id, name, preis, beschreibung, bild FROM gericht ORDER BY gericht_id ASC";
    $run_query = mysqli_query($con,$gericht_query);
    if(mysqli_num_rows($run_query) > 0){
        while($row = mysqli_fetch_array($run_query)){
            $g_id    = $row['gericht_id'];
            $g_be = $row['beschreibung'];
            $g_name = $row['name'];
            $g_preis = $row['preis'];
            $g_bild = $row['bild'];
            echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$g_name</div>
								<div class='panel-body'>
									<img src='$g_bild' style='width:350px; height:250px;'/>
								</div>
								<p class=\"description\">$g_be</p>
								<div class='panel-heading'>$g_preis €
									<button pid='$g_id' style='float:right;' id='gericht' class='btn btn-primary btn-xs'>IndenWarenkorb</button>
								</div>
							</div>
						</div>";
        }
    }
}
if(isset($_POST["getTagesangebot1"])){

    $tagesangebot_query = "SELECT gericht_id, name, preis FROM gericht WHERE gericht_id ='9' ";
    $run_query1 = mysqli_query($con,$tagesangebot_query);
    if(mysqli_num_rows($run_query1) > 0){
        while($row = mysqli_fetch_array($run_query1)){
            $tid    = $row['gericht_id'];
            $tname = $row['name'];
            $tpreis = $row['preis'];
            echo "<div><button pid='$tid' style='float:right;' id='gericht' class='btn btn-primary' style='background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#267c99), color-stop(50%,#007299));'>IndenWarenkorb</button> </div>";
            echo "<div style='position: relative; left: 690px; top: -83px;'><b><h3>$tpreis €</h3> </b></div>";

        }
    }
}
if(isset($_POST["getTagesangebot2"])){

    $tagesangebot_query = "SELECT gericht_id, name, preis FROM gericht WHERE gericht_id ='10'";
    $run_query1 = mysqli_query($con,$tagesangebot_query);
    if(mysqli_num_rows($run_query1) > 0){
        while($row = mysqli_fetch_array($run_query1)){
            $tid    = $row['gericht_id'];
            $tname = $row['name'];
            $tpreis = $row['preis'];
            echo "<div><button pid='$tid' style='float:right;' id='gericht' class='btn btn-primary' style='background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#267c99), color-stop(50%,#007299));'>IndenWarenkorb</button> </div>";
            echo "<div style='position: relative; left: 690px; top: -83px;'><b><h3>$tpreis €</h3> </b></div>";

        }
    }
}
if(isset($_POST["getTagesangebot3"])){

    $tagesangebot_query = "SELECT gericht_id, name, preis FROM gericht WHERE gericht_id ='11'";
    $run_query1 = mysqli_query($con,$tagesangebot_query);
    if(mysqli_num_rows($run_query1) > 0){
        while($row = mysqli_fetch_array($run_query1)){
            $tid    = $row['gericht_id'];
            $tname = $row['name'];
            $tpreis = $row['preis'];

            echo "<div><button pid='$tid' style='float:right;' id='gericht' class='btn btn-primary' style='background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#267c99), color-stop(50%,#007299));'>IndenWarenkorb</button> </div>";
            echo "<div style='position: relative; left: 690px; top: -83px;'><b><h3>$tpreis €</h3> </b></div>";

        }
    }
}

if(isset($_POST["suchen"])){
    $schlusselwort = $_POST["schlusselwort"];
    $sql = "SELECT * FROM gericht WHERE Schlussel_Worter LIKE '%$schlusselwort%'";

    $run_query = mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_query)){

                $g_id = $row['Gericht_ID'];
                $g_be = $row['Beschreibung'];
                $g_name = $row['Name'];
                $g_preis = $row['Preis'];
                $g_bild = $row['Bild'];
                echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$g_name</div>
								<div class='panel-body'>
									<img src='$g_bild' style='width:350px; height:250px;'/>
								</div>
								<p class=\"description\">$g_be</p>
								<div class='panel-heading'>$g_preis.€
									<button pid='$g_id' style='float:right;' id='gericht' class='btn btn-primary btn-xs'>IndenWarenkorb</button>
								</div>
							</div>
						</div>";


            }
}
if(isset($_POST["addGericht"])) {
    if (isset($_SESSION["kid"])){
        $g_id = $_POST["geID"];
        $kunde_id = $_SESSION["kid"];
        $sql = "SELECT * FROM warenkorb WHERE `gericht_id` = '$g_id' AND `kunde_id` = '$kunde_id' ;";
        //print $sql;
        $run_query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($run_query);
        if ($count > 0) {
            echo "<div class='alert alert-success'style='position: relative; left: 110px';>
					<a href='#' class='close' data-dismiss='alert' aria-label='close' >&times;</a>
				<b>Dieses Gericht ist schon da.Sie können weitereinkaufen...! </b>
				</div>"; ;
        } else{
            $sql = "SELECT gericht_id, name, bild , preis FROM gericht WHERE `gericht_id` = '$g_id' ; ";
            //print $sql;
            $run_query = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($run_query);
            $ge_id = $row ["gericht_id"];
            $ge_name = $row["name"];
            $ge_bild = $row["bild"];
            $ge_preis = $row["preis"];
            $sql = "INSERT INTO `warenkorb` (`Warenkorb_ID`, `Gericht_ID`, `IP_ADD`, `Kunde_ID`, `Gericht_Name`, `Gericht_Bild`, `Menge`, `Preis`, `Gesamtpreis`) 
                VALUES (NULL, '$g_id', '0', '$kunde_id', '$ge_name', '$ge_bild', '1', '$ge_preis', '$ge_preis');";
            //print $sql;
            if(mysqli_query($con, $sql)){
                echo "<div class='alert alert-success' style='position: relative; left: 110px';>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Gericht ist erfolgreich in Warenkorb gestellt...!</b>
				</div>";
            }
        }

    }else{
        echo "<div class='alert alert-success' style='position: relative; left: 110px';>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Damit Sie bei uns kaufen können, müssen Sie sich registrieren! Danke für Ihren Verständniss.</b>
				</div>";

    }


}
if(isset($_POST["get_warenkorb_gericht"])|| isset($_POST["warenkorb_kaufen"])) {
    $kid = $_SESSION["kid"];

    $sql = "SELECT warenkorb_id, gericht_id, gericht_name, gericht_bild, preis,menge, gesamtpreis  FROM warenkorb WHERE kunde_id = '$kid'";
    $run_query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($run_query);
    if ($count > 0) {
        $nr = 1;
        $gesamt_preis = 0;
        while ($row = mysqli_fetch_array($run_query)) {
            $warenkorb_id = $row["warenkorb_id"];
            $ge_id = $row["gericht_id"];
            $ge_name = $row["gericht_name"];
            $ge_bild = $row["gericht_bild"];
            $menge = $row["menge"];
            $ge_preis = $row["preis"];
            $gesamt = $row["gesamtpreis"];
            $preis_array = array($gesamt);
            $gesamt_sum = array_sum($preis_array);
            $gesamt_preis = $gesamt_preis + $gesamt_sum;
            setcookie("gesamt_preis",$gesamt_preis,strtotime('+1 days'),"/","","",TRUE);


if(isset($_POST["get_warenkorb_gericht"])){
    echo "<div class='row'>
                                    <div class=\"col-md-3\">$nr</div>
                                    <div class=\"col-md-3\"><img src='$ge_bild' width='60px' height='50px'></div>
                                    <div class=\"col-md-3\">$ge_name</div>
                                    <div class=\"col-md-3\">€.$ge_preis</div>
                                </div>";
    $nr = $nr+1;

}else{
    echo "<div class='row'>
                            <div class='col-md-1'>$nr</div>
							<div class='col-md-2'>$ge_name</div>
							<div class='col-md-1'><img src='$ge_bild' width='60px' height='60px'></div>
							<div class='col-md-2'><input type='text' class='form-control menge' pid='$ge_id' id='menge-$ge_id' value='$menge' ></div>
							<div class='col-md-2'><input type='text' class='form-control preis' pid='$ge_id' id='preis-$ge_id' value='$ge_preis' disabled></div>
							<div class='col-md-2'><input type='text' class='form-control gesamt' pid='$ge_id' id='gesamt-$ge_id' value='$gesamt' disabled></div>
							<div class='col-md-2'>
								<div class='btn-group'>
									<a href='#' entfernen_id='$ge_id'  class='btn btn-danger entfernen'><span class='glyphicon glyphicon-trash'></span></a>
									<a href='' aktualisieren_id='$ge_id' class='btn btn-primary aktualisieren'><span class='glyphicon glyphicon-ok-sign'></span></a>
								</div>
							</div>
						</div>  ";
    $nr = $nr+1;
          }

        }
        if(isset($_POST["warenkorb_kaufen"])){
            echo "
            <div class='row'>
            <div class='col-md-8'></div>
            <div class='col-md-4'>
            <b>Gesamtpreis: $gesamt_preis €</b>
            </div>
            ";

        }

    }
}
if(isset($_POST["warenkorb_menge"])AND isset($_SESSION["kid"])){
    $kid = $_SESSION["kid"];
    $sql = "SELECT kunde_id FROM warenkorb WHERE kunde_id = '$kid'";
    $run_query = mysqli_query($con,$sql);
    echo mysqli_num_rows($run_query);
}
if(isset($_POST["entfernenVonWarenkorb"])){
    $gid = $_POST["entfernenID"];
    $kid = $_SESSION["kid"];
    $sql = "DELETE FROM warenkorb WHERE kunde_id = '$kid' AND gericht_id ='$gid'";
    //print $sql;
    $run_query= mysqli_query($con,$sql);
    if($run_query){
        echo "<div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Gericht ist gelöscht von Warenkorb...!</b>
				</div>";
    }

}
if(isset($_POST["aktualisierenGericht"])){
    $kid = $_SESSION["kid"];
    $gid = $_POST["aktualisierenID"];
    $menge = $_POST["menge"];
    $preis = $_POST["preis"];
    $gesamt = $_POST["gesamt"];

    $sql= "UPDATE warenkorb SET menge = '$menge', preis = '$preis', gesamtpreis = '$gesamt' WHERE  kunde_id = '$kid' AND gericht_id = '$gid'";
    //print $sql;
    $run_query = mysqli_query($con,$sql);
    if($run_query){
        echo"<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Gericht ist aktualisiert in Warenkorb...!</b>
				</div>";
    }
}
if(isset($_POST["kunde_information"])) {
    $kid = $_SESSION["kid"];

    $sql1 = "SELECT * FROM kunde WHERE Kunde_ID = '$kid';";
    $run_query = mysqli_query($con, $sql1);
    //print $sql1;
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $kname = $row['Name'];
            $kvorname = $row['Vorname'];
            $ktelefonnummer = $row['Telefonnummer'];
            $kemail = $row['Email'];
            echo "
                            <div class='col-md-6'><b>Vorname</b><input type='text' class='form-control' pid='' id='' value='$kvorname' disabled ></div>
							<div class='col-md-6'><b>Name</b><input type='text' class='form-control' pid='' id='' value='$kname' disabled></div>
							<div class='col-md-6'><b>E-Mail</b><input type='text' class='form-control' pid='' id='' value='$kemail' disabled></div>
					        <div class='col-md-6'><b>Telefonnummer</b><input type='text' class='form-control preis' pid='' id='' value='0$ktelefonnummer' disabled></div>


										 ";


        }
    }
    $sql2 = "SELECT adresse.Strasse, adresse.PLZ , adresse.Stadt, adresse.Hausnummer, adresse.Adresse_ID FROM adresse INNER JOIN kunde ON adresse.Adresse_ID=kunde.Adresse_ID WHERE kunde.Kunde_ID='$kid';";
    $run_query = mysqli_query($con, $sql2);
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $strasse = $row['Strasse'];
            $stadt = $row['Stadt'];
            $plz = $row['PLZ'];
            $hausnummer = $row['Hausnummer'];
            echo " 
                            <div class='col-md-6'><b>Strasse</b><input type='text' class='form-control preis' pid='' id='' value='$strasse' disabled></div>
                            <div class='col-md-6'><b>Hausnummer</b><input type='text' class='form-control preis' pid='' id='' value='$hausnummer' disabled></div>
                            <div class='col-md-6'><b>Stadt</b><input type='text' class='form-control preis' pid='' id='' value='$stadt' disabled></div>
                            <div class='col-md-6'><b>PLZ</b><input type='text' class='form-control preis' pid='' id='' value='$plz' disabled></div>
 
                              ";


        }
    }
    $result = $con->query("SELECT bankverbindung.Bankverbindung_ID, bankverbindung.Besitzer_Vorname , bankverbindung.Besitzer_Name,bankverbindung.IBAN,bankverbindung.BIC,bankverbindung.Kartennummer,bankverbindung.CVV
                                    FROM bankverbindung INNER JOIN besitzt ON  bankverbindung.Bankverbindung_ID=besitzt.Bankverbindung_ID 
                                    WHERE besitzt.Kunde_ID = '$kid';");
    if ($result->num_rows == 0) {
        echo "<div>&nbsp</div>";
        echo " <a href='addbankverbindung.php' id='kundeakt_btn' class='btn btn-primary ' role='button' style='position:relative; left: 860px ; '>Add Bankverbindung</a>";



    } else {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $bvorname = $row['Besitzer_Vorname'];
                $bname = $row['Besitzer_Name'];
                $iban = $row['IBAN'];
                $bic = $row['BIC'];
                $kartennumer = $row['Kartennummer'];
                $cvv = $row['CVV'];

                if (empty($kartennumer) || empty($cvv)) {
                    echo " 
                            <div class='col-md-6'><b>Besitzer Vorname</b><input type='text' class='form-control preis' pid='' id='' value='$bvorname' disabled></div>
                            <div class='col-md-6'><b>Besitzer Name</b><input type='text' class='form-control preis' pid='' id='' value='$bname' disabled></div>
                            <div class='col-md-6'><b>IBAN</b><input type='text' class='form-control preis' pid='' id='' value='$iban' disabled></div>
                            <div class='col-md-6'><b>BIC</b><input type='text' class='form-control preis' pid='' id='' value='$bic' disabled></div>
 
                              ";

                } else {
                   echo  " 
                            <div class='col-md-6'><b>Besitzer Vorname</b><input type='text' class='form-control preis' pid='' id='' value='$bvorname' disabled></div>
                            <div class='col-md-6'><b>Besitzer Name</b><input type='text' class='form-control preis' pid='' id='' value='$bname' disabled></div>
                            <div class='col-md-6'><b>Kartennummer</b><input type='text' class='form-control preis' pid='' id='' value='$kartennumer' disabled></div>
                            <div class='col-md-6'><b>CVV</b><input type='text' class='form-control preis' pid='' id='' value='$cvv' disabled></div>
 
                              ";




                }


            }
        }
    }
}
if(isset($_POST["bestellungInformation"])) {


    $kid = $_SESSION['kid'];
    $result = $con->query("SELECT * FROM bestellung WHERE Kunde_ID = '$kid';");
    if ($result->num_rows == 0) {
        echo "<h3><b>Sie haben keine Bestellung gemacht. </b></h3>
              <h3><b>Um bei uns einzukaufen, drücken Sie bitte hier unter!!!</b></h3>
              <a href=\"profile.php\" class=\"btn btn-success btn-lg\" style='position: relative; left: 500px'>Einkaufen</a>";

    } else {

            $kid = $_SESSION['kid'];


            $sql = "SELECT * FROM bestellung WHERE Kunde_ID = '$kid';";
            $run_query = mysqli_query($con, $sql);
            //print $sql;
            if (mysqli_num_rows($run_query) > 0) {
                $nr = 1;
                $gesamt_preis = 0;

                while ($row = mysqli_fetch_array($run_query)) {
                    $gerichtname = $row['Gericht_Name'];
                    $gerichtmenge = $row['Gericht_Menge'];
                    $bestelldatum = $row['Bestelldatum'];
                    $gesamtpreis = $row['Gesamtpreis'];
                    $bstatus = $row['Status'];

                    echo "<div class='row'>
                                    <div class=\"col-md-1\">$nr</div>
                                    <div class=\"col-md-2\">$gerichtname</div>
                                    <div class=\"col-md-1\">$gerichtmenge</div>
                                    <div class=\"col-md-2\">$bestelldatum</div>
                                    <div class=\"col-md-1\">$gesamtpreis</div>
                                    <div class=\"col-md-2\">$bstatus</div>
                                    
                                </div>
                                ";

                    $nr = $nr + 1;


                }
            }

            $kid = $_SESSION['kid'];
            $sql = "SELECT SUM(CASE WHEN Kunde_ID = '$kid' THEN Gesamtpreis END) as total FROM bestellung";
            if ($result = mysqli_query($con, $sql)) {
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_array($result)) {

                        $total = $row['total'];
                        echo "<div style='position: relative; left: 335px'><h3><b>Gesamtpreis: $total €</b></h3></div>";


                    }
                }
            }
        }
}
if(isset($_POST["bestellungAdmin"])) {

    $kid = $_SESSION['kid'];
    $sql = "SELECT Kunde_ID FROM kunde WHERE Rol = 'admin' ";
    $result = mysqli_query($con,$sql) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $row_admin_id = $row["Kunde_ID"];
    //print $row_admin_id;
    if($kid==$row_admin_id){


    $sql1 = "SELECT * FROM bestellung";
    $run_query = mysqli_query($con, $sql1);
    //print $sql;
    if (mysqli_num_rows($run_query) > 0) {
        $nr = 1;
        $gesamt_preis = 0;

        while ($row = mysqli_fetch_array($run_query)) {
            $gerichtname = $row['Gericht_Name'];
            $gerichtmenge = $row['Gericht_Menge'];
            $bestelldatum = $row['Bestelldatum'];
            $gesamtpreis = $row['Gesamtpreis'];
            $kundeid = $row['Kunde_ID'];
            $bid = $row['Bestellung_ID'];
            $bstatus = $row['Status'];
            echo "<div class='row'>
                                    <div class=\"col-md-1\">$nr</div>
                                    <div class=\"col-md-2\">$gerichtname</div>
                                    <div class=\"col-md-1\">$gerichtmenge</div>
                                    <div class=\"col-md-1\">$kundeid</div>
                                    <div class=\"col-md-2\">$bestelldatum</div>
                                    <div class=\"col-md-2\">$gesamtpreis</div>
                                    <div style='position: relative; right: 130px' class=\"col-md-1\">$bstatus</div>
                                    <div class='btn-group' style='position: relative; right: 80px'>
									<a href='#' baktualisieren_id='$bid' class='btn btn-primary baktualisieren'><span class='glyphicon glyphicon-ok-sign'></span></a>
									<a href='#' baktualisieren_id1='$bid' class='btn btn-danger baktualisieren1'><span class='glyphicon glyphicon-refresh'></span></a>
                                    <a href='#' baktualisieren_id2='$bid' class='btn btn-success baktualisieren2'><span class='glyphicon glyphicon-map-marker'></span></a>
								</div>
                                    
                                </div>
                                ";

            $nr = $nr + 1;


        }
    }

}else{
        echo "<div><h1><b>Sie haben keine Rechte auf diese Seite!!!</b></h1></div>";
    }
}
if(isset($_POST["aktualisierenBestellung"])){
    $bid = $_POST["baktualisierenID"];
    $sql= "UPDATE bestellung SET Status = 'in Bearbeitung' WHERE Bestellung_ID ='$bid' ";
    //print $sql;
    $run_query = mysqli_query($con,$sql);
    if($run_query){
        echo"<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Status wurde in 'in Bearbeitung' aktualisiert..!</b>
				</div>";
    }
}
if(isset($_POST["aktualisierenBestellung1"])){
    $bid = $_POST["baktualisierenID1"];
    $sql= "UPDATE bestellung SET Status = 'unterwegs' WHERE Bestellung_ID ='$bid' ";
    //print $sql;
    $run_query = mysqli_query($con,$sql);
    if($run_query){
        echo"<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Status wurde in 'unterwegs' aktualisiert..!</b>
				</div>";
    }
}
if(isset($_POST["aktualisierenBestellung2"])){
    $bid = $_POST["baktualisierenID2"];
    $sql= "UPDATE bestellung SET Status = 'wurde zugestellt' WHERE Bestellung_ID ='$bid' ";
    //print $sql;
    $run_query = mysqli_query($con,$sql);
    if($run_query){
        echo"<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Status wurde in 'wurde zugestellt' aktualisiert..!</b>
				</div>";
    }
}
?>