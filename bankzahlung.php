<?php
include "db.php";

session_start();
if(!isset($_SESSION["kid"])){
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FoodPorn</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" style="background-color: #000212; border-color: #f4e6f5;>
		<div class="container-fluid">	
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand">FoodPorn</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>

			</ul>
		</div>
	</div>

    <p><br/></p>
    <p><br/></p>
    <p><br/></p>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">



                            <?php


                            $kid = $_SESSION['kid'];
                            $result = $con->query("SELECT * FROM warenkorb WHERE Kunde_ID = '$kid';");
                            if($result->num_rows == 0) {
                                echo "<h3><b>Sie haben keine Ware ausgewählt. Um Ihre Bestellungen zu sehen drücken Sie bitte hier unter!!!</b></h3>
                                          </p>
                                          <a href=\"meinebestellung.php\" class=\"btn btn-success btn-lg\">Meine Bestellungen</a>";

                            }else {

                                $kid = $_SESSION['kid'];


                                $result = $con->query("SELECT bankverbindung.Bankverbindung_ID, bankverbindung.Besitzer_Vorname , bankverbindung.Besitzer_Name, bankverbindung.Kartentyp, bankverbindung.IBAN,bankverbindung.BIC,bankverbindung.Kartennummer,bankverbindung.CVV
                                    FROM bankverbindung INNER JOIN besitzt ON  bankverbindung.Bankverbindung_ID=besitzt.Bankverbindung_ID 
                                    WHERE besitzt.Kunde_ID = '$kid';");
                                if ($result->num_rows == 0) {
                                    echo "<h3><b>Sie haben keine Bankverbindung!!!</b></h3>
                                          </p>
                                          <a href=\"addbankverbindung.php\" class=\"btn btn-success btn-lg\">Add Bankverbindung</a>";

                                } else {
                                    echo "<h1>Danke </h1> <hr/>  <p>";

                                    echo "Hallo";
                                    $username = $_SESSION["username"];
                                    echo "<b> $username </b> ";
                                    echo "Danke für Ihren Einkauf Ihre Bestellung kommt an folgende Adresse :";

                                    $sql1 = "SELECT adresse.Strasse, adresse.PLZ , adresse.Stadt, adresse.Hausnummer, adresse.Adresse_ID FROM adresse INNER JOIN kunde ON adresse.Adresse_ID=kunde.Adresse_ID WHERE kunde.Kunde_ID='$kid';";
                                    //print $sql;
                                    if ($result = mysqli_query($con, $sql1)) {
                                        if (mysqli_num_rows($result) > 0) {

                                            while ($row = mysqli_fetch_array($result)) {

                                                $strasse = $row['Strasse'];
                                                $hausnummer = $row["Hausnummer"];
                                                $stadt = $row["Stadt"];
                                                $plz = $row["PLZ"];
                                                $adresseid = $row["Adresse_ID"];

                                                echo "<b>$strasse </b>";
                                                echo "<b>$hausnummer </b>";
                                                echo "<b>$stadt </b>";
                                                echo "<b>$plz </b>";
                                            }
                                        }
                                    }
                                    echo " spätestens in 30 Minuten.Das Betrag in höhe von ";
                                    $cookie_gesamt_preis = $_COOKIE["gesamt_preis"];
                                    echo "<b>$cookie_gesamt_preis €</b>";
                                    echo " wurde auf Ihrem volgende Konto :";

                                    $sql2 = "SELECT bankverbindung.Bankverbindung_ID, bankverbindung.Besitzer_Vorname , bankverbindung.Besitzer_Name, bankverbindung.Kartentyp, bankverbindung.IBAN,bankverbindung.BIC,bankverbindung.Kartennummer,bankverbindung.CVV
                                    FROM bankverbindung INNER JOIN besitzt ON  bankverbindung.Bankverbindung_ID=besitzt.Bankverbindung_ID 
                                    WHERE besitzt.Kunde_ID = '$kid' ;";
                                    //print $sql;
                                    if ($result = mysqli_query($con, $sql2)) {
                                        if (mysqli_num_rows($result) > 0) {

                                            while ($row = mysqli_fetch_array($result)) {

                                                $iban = $row['IBAN'];
                                                $bic = $row["BIC"];
                                                $krtnmr = $row["Kartennummer"];
                                                $cvv = $row["CVV"];
                                                $name = $row["Besitzer_Name"];
                                                $vorname = $row["Besitzer_Vorname"];

                                                if (empty($krtnmr) || empty($cvv)) {
                                                    echo "<b>IBAN: $iban </b>";
                                                    echo "<b>BIC: $bic </b>";

                                                } else {
                                                    echo "<b>Kartennummer: $krtnmr </b>";
                                                    echo "<b>CVV: $cvv </b>";
                                                    echo "<b>Vorname: $vorname</b>";
                                                    echo "<b> Name: $name</b>";


                                                }
                                            }
                                        }

                                    }

                                    echo " schon gebucht.";


                                    $datum = date('Y-m-d H:i:s');

                                    $sql = "INSERT INTO bestellung ( `Gesamtpreis`, `Bestelldatum`, `Zahlungsart`, `Kunde_ID`, `Adresse_ID`, `Gericht_Menge`, `Gericht_Name`, `Gericht_ID`)
                                    SELECT Gesamtpreis, '$datum', 'Karte', '$kid', '$adresseid', Menge, Gericht_Name,Gericht_ID FROM warenkorb WHERE Kunde_ID = '$kid';";
                                    $sql .= "DELETE  FROM warenkorb WHERE Kunde_ID = '$kid';";
                                    $run_query = mysqli_multi_query($con, $sql);
                                    //print $sql;
                                    echo "<b></b><br/>
                            Sie können weiter bei uns einkaufen <br/>
                            </p>
                        <a href=\"index.php\" class=\"btn btn-success btn-lg\">Weiter zum Einkauf</a>";
                                }
                            }
                            ?>
                    </div>
                    <div class="panel-footer">&copy; 2017 Cananau Cristian&Celac Veronica</div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>
</html>

	
</body>
</html>
