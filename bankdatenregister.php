<?php
include "db.php";

session_start();
if(!isset($_SESSION["kid"])){
    header("location:index.php");
}

$iban = $_POST['iban'];
$bic = $_POST['bic'];
$kartennumer = $_POST['kartennumer'];
$cvv = $_POST['cvv'];
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";
$ibanValidation = "/(?:DE)+((?:[0-9]{6}[ \\-]{1}[0-9]{12}|[0-9]{20}))(?![\\d])/" ;
$bicValidation = "/[aA-zZ]{8}/";
$kartennumerValidation = "/([4-5]\d{14})/";
$cvvValidation ="/([1-9]\d{2})/";

if(!((!empty($iban) && !empty($bic)) || (!empty($kartennumer) && !empty($cvv)))) {
    echo "
    <div class='alert alert-warning'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Bitte geben Sie alle benötigte dafür Felder ein...!</b>
    </div>
";
    exit();
}
if (!((!preg_match($ibanValidation,$iban)&& !preg_match($bicValidation,$bic)) || (!preg_match($kartennumerValidation,$kartennumer)&& !preg_match($cvvValidation,$cvv)))){
    echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Bank- oder Kartendaten sind ungültig. Bitte geben Sie gültige Daten ein...!</b>
			</div>
		";
    exit();
}
    $kid = $_SESSION['kid'];

    $sql = "SELECT * FROM kunde WHERE Kunde_ID='$kid';";
    //print $sql;
    if ($result = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {

                $name = $row['Name'];
                $vorname = $row["Vorname"];

            }
        }
    }

    if (empty($kartennumer) || empty($cvv)) {
        if(!preg_match($ibanValidation,$iban)||(!preg_match($bicValidation,$bic))){
    echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Bitte geben Sie einen gültigen IBAN oder BIC ein..!</b>
			</div>
		";
    exit();
}


        $sql3 = "INSERT INTO `bankverbindung` (`Bankverbindung_ID`, `Besitzer_Vorname`, `Besitzer_Name`, `Kartentyp`, `IBAN`, `BIC`, `Kartennummer`, `CVV`) 
                            VALUES (NULL, '$vorname', '$name', '', '$iban', '$bic', NULL, NULL);";
        $run_query3 = mysqli_query($con, $sql3);
        //print $sql3;
        $bank="SELECT Bankverbindung_ID FROM bankverbindung WHERE Besitzer_Vorname = '$vorname' AND Besitzer_Name = '$name' AND IBAN = '$iban' AND BIC= '$bic'; ";
        //print $bank;
        $result = mysqli_query($con,$bank) or die(mysqli_error($con));
        $row = mysqli_fetch_array($result);
        $row_bank_id = $row["Bankverbindung_ID"];
        //print $row_bank_id;
        $sql5 ="INSERT INTO `besitzt` (`Kunde_ID`, `Bankverbindung_ID`) VALUES ('$kid', '$row_bank_id');";
        $run_query5 = mysqli_query($con,$sql5);
        if ($run_query3) {
            echo "
                 <div class='alert alert-success'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                 <b>Bankdaten sind erfolgreich registriert...!</b>
                 </div>
                        ";

        }
    } else {
        if(!preg_match($kartennumerValidation,$kartennumer)||(!preg_match($cvvValidation,$cvv))){
    echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Bitte geben Sie einen gültigen Kartennummer oder CVV ein..!</b>
			</div>
		";
    exit();
}
        $sql4 = "INSERT INTO `bankverbindung` (`Bankverbindung_ID`, `Besitzer_Vorname`, `Besitzer_Name`, `Kartentyp`, `IBAN`, `BIC`, `Kartennummer`, `CVV`) 
                            VALUES (NULL, '$vorname', '$name', '', NULL, NULL ,'$kartennumer', '$cvv');";
        $run_query4 = mysqli_query($con, $sql4);
        print $sql4;
        $bank1="SELECT Bankverbindung_ID FROM bankverbindung WHERE Besitzer_Vorname = '$vorname' AND Besitzer_Name = '$name' AND Kartennummer = '$kartennumer' AND CVV= '$cvv'; ";
        print $bank1;
        $result = mysqli_query($con,$bank1) or die(mysqli_error($con));
        $row = mysqli_fetch_array($result);
        $row_bank_id1 = $row["Bankverbindung_ID"];
        $sql6 ="INSERT INTO `besitzt` (`Kunde_ID`, `Bankverbindung_ID`) VALUES ('$kid', '$row_bank_id1');";
        $run_query6 = mysqli_query($con,$sql6);
        print $sql6;
        if ($run_query4) {
            echo "
                 <div class='alert alert-success'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                 <b>Kartendaten sind erfolgreich registriert...!</b>
                 </div>
                        ";
        }

    }



?>