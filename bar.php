<?php
include ('db.php');

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
    <style>
        table tr td {padding:10px;}
    </style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top"style="background-color: #000212; border-color: #f4e6f5;>
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">FoodPorn</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="profile.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
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
                    <hr/>
                    <p>

                         <?php


                         $kid = $_SESSION['kid'];
                         $result = $con->query("SELECT * FROM warenkorb WHERE Kunde_ID = '$kid';");
                         if($result->num_rows == 0) {
                             echo "<h3><b>Sie haben keine Ware ausgewählt. Um Ihre Bestellungen zu sehen drücken Sie bitte hier unter!!!</b></h3>
                                          </p>
                                          <a href=\"meinebestellung.php\" class=\"btn btn-success btn-lg\">Meine Bestellungen</a>";

                         }else {
                             echo "<h1>Danke </h1> <hr/>  <p>";

                             echo "Hello";
                             $username = $_SESSION["username"];
                             echo "<b> $username </b> ";
                             echo "Danke für Ihren Einkauf Ihre Bestellung kommt an folgende Adresse :";
                             $kid = $_SESSION['kid'];
                             $sql = "SELECT adresse.Strasse, adresse.PLZ , adresse.Stadt, adresse.Hausnummer, adresse.Adresse_ID FROM adresse INNER JOIN kunde ON adresse.Adresse_ID=kunde.Adresse_ID WHERE kunde.Kunde_ID='$kid';";
                             if ($result = mysqli_query($con, $sql)) {
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
                             echo "spätestens in 30 Minuten.Bis dann Vorbereiten Sie  bitte";
                             $cookie_gesamt_preis = $_COOKIE["gesamt_preis"];
                             echo "<b>$cookie_gesamt_preis € !</b>";
                             echo "<b></b><br/>
                        Sie können weiter bei uns einkaufen <br/></p>";
                             $datum = date('Y-m-d H:i:s');


                             $sql = "INSERT INTO bestellung ( `Gesamtpreis`, `Bestelldatum`, `Zahlungsart`, `Kunde_ID`, `Adresse_ID`, `Gericht_Menge`, `Gericht_Name`, `Gericht_ID`)
                                 SELECT Gesamtpreis, '$datum', 'Bar', '$kid', '$adresseid', Menge, Gericht_Name, Gericht_ID FROM warenkorb WHERE Kunde_ID = '$kid';";
                             $sql .= "DELETE  FROM warenkorb WHERE Kunde_ID = '$kid';";
                             $run_query = mysqli_multi_query($con, $sql);
                             //print $sql;
                             echo "<b></b><br/>
                            Sie können weiter bei uns einkaufen <br/>
                            </p>
                        <a href=\"index.php\" class=\"btn btn-success btn-lg\">Weiter zum Einkauf</a>";

                         }
                         ?>

                </div>
            </div>
                <div class="panel-footer">&copy; 2017 Cananau Cristian&Celac Veronica</div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</body>
</html>


