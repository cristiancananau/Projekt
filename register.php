<?php

include "db.php";


$f_name = $_POST["f_name"];
$l_name = $_POST["l_name"];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$mobile = $_POST['mobile'];
$strasse = $_POST['strasse'];
$hausnummer = $_POST['hausnummer'];
$stadt= $_POST['stadt'];
$plz = $_POST['plz'];
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

if(empty($username)||empty($email)|| empty($f_name) ||empty($l_name) || empty($password) || empty($repassword) || empty($mobile) || empty($strasse)||empty($hausnummer)||empty($stadt)||empty($plz)
    || !((!empty($iban) && !empty($bic)) || (!empty($kartennumer) && !empty($cvv)))) {
    echo "
    <div class='alert alert-warning'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Bitte geben Sie alle Felder ein...!</b>
    </div>
";
    exit();
}

if(!preg_match($emailValidation,$email)){
        echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b> $email ist schon ungültig. Bitte geben Sie ein gültiges E-Mail ein..!</b>
			</div>
		";
        exit();
    }

	if(strlen($password) < 6 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Das Password ist zu einfach</b>
			</div>
		";
		exit();
	}
	if(strlen($repassword) < 6 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Das Password ist zu einfach</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Die Passworte stimmen nicht überein</b>
			</div>
		";
	}
	if(!preg_match($number,$mobile)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Telefonnumer $mobile ist nicht da</b>
			</div>
		";
		exit();
	}
if(!((preg_match($ibanValidation,$iban)&& preg_match($bicValidation,$bic))|| (preg_match($kartennumerValidation,$kartennumer)&& preg_match($cvvValidation,$cvv)))){
    echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Bank- oder Kartendaten sind ungültig. Bitte geben Sie gültige Daten ein...!</b>
			</div>
		";
    exit();
    }
	if(!(strlen($mobile) == 11)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Muss länger als 10 sein</b>
			</div>
		";
		exit();
	}


//if(!preg_match($ibanValidation,$iban)&&(!preg_match($bicValidation,$bic))){
//    echo "
//			<div class='alert alert-warning'>
//				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
//				<b>$iban oder $bic ist flasch.Bitte geben Sie einen gültigen IBAN ein..!</b>
//			</div>
//		";
//    exit();
//}

//if(!preg_match($kartennumerValidation,$kartennumer)&&(!preg_match($cvvValidation,$cvv))){
//    echo "
//			<div class='alert alert-warning'>
//				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
//				<b>Bitte geben Sie einen gültigen Kartennummer oder CVV ein..!</b>
//			</div>
//		";
//    exit();
//}

	$sql = "SELECT email, username FROM kunde WHERE email = '$email' OR username = '$username' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	//print $sql;
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>E-mail Adresse oder Username ist schon vorhanden , geben Sie bitte eine andere ein...!</b>
			</div>
		";
		exit();
	} else {

        $sql1="INSERT INTO `adresse`(`strasse`, `hausnummer`, `stadt`, `plz`)
        VALUES ('$strasse', '$hausnummer', '$stadt','$plz');";
        $run_query1 = mysqli_query($con,$sql1);
        //print $sql1;

        $adresse="SELECT adresse_id FROM adresse WHERE strasse = '$strasse' AND plz = '$plz' AND stadt = '$stadt' AND hausnummer= '$hausnummer'; ";
        //print $adresse;
        $result = mysqli_query($con,$adresse) or die(mysqli_error($con));
        $row = mysqli_fetch_array($result);
        $row_add_id = $row["adresse_id"];
        //print $row_add_id;

        $password = ($password);
        $sql2= "INSERT INTO `kunde`(`name`, `vorname`, `username`, `email`,`password`, `telefonnummer` , `adresse_id`)
                 VALUES ('$f_name', '$l_name', '$username', '$email','$password', '$mobile', '$row_add_id');";
        $run_query2 = mysqli_query($con,$sql2);
        //print $sql2;

        if(empty($kartennumer)|| empty($cvv)){
            $sql3="INSERT INTO `bankverbindung` (`Bankverbindung_ID`, `Besitzer_Vorname`, `Besitzer_Name`, `Kartentyp`, `IBAN`, `BIC`, `Kartennummer`, `CVV`) 
                            VALUES (NULL, '$f_name', '$l_name', '', '$iban', '$bic', NULL, NULL);";
            $run_query3 = mysqli_query($con,$sql3);
            //print $sql3;
            $bank="SELECT Bankverbindung_ID FROM bankverbindung WHERE Besitzer_Vorname = '$f_name' AND Besitzer_Name = '$l_name' AND IBAN = '$iban' AND BIC= '$bic'; ";
            //print $bank;
            $result = mysqli_query($con,$bank) or die(mysqli_error($con));
            $row = mysqli_fetch_array($result);
            $row_bank_id = $row["Bankverbindung_ID"];
            //print $row_bank_id;
            $kundeid="SELECT Kunde_ID FROM kunde WHERE Username ='$username'; ";
            $result = mysqli_query($con,$kundeid) or die(mysqli_error($con));
            //print $kundeid;
            $row = mysqli_fetch_array($result);
            $row_kundeid = $row["Kunde_ID"];
            //print $row_kundeid;
			$sql5 ="INSERT INTO `besitzt` (`Kunde_ID`, `Bankverbindung_ID`) VALUES ('$row_kundeid', '$row_bank_id');";
            $run_query5 = mysqli_query($con,$sql5);


        }else{
        	$sql4="INSERT INTO `bankverbindung` (`Bankverbindung_ID`, `Besitzer_Vorname`, `Besitzer_Name`, `Kartentyp`, `IBAN`, `BIC`, `Kartennummer`, `CVV`) 
                            VALUES (NULL, '$f_name', '$l_name', '', NULL, NULL ,'$kartennumer', '$cvv');";
            $run_query4 = mysqli_query($con,$sql4);
            //print $sql4;
            $bank1="SELECT Bankverbindung_ID FROM bankverbindung WHERE Besitzer_Vorname = '$f_name' AND Besitzer_Name = '$l_name' AND Kartennummer = '$kartennumer' AND CVV= '$cvv'; ";
            $result = mysqli_query($con,$bank1) or die(mysqli_error($con));
            //print $bank1;
            $row = mysqli_fetch_array($result);
            $row_bank_id1 = $row["Bankverbindung_ID"];
            //print $row_bank_id1;
            $kundeid="SELECT Kunde_ID FROM kunde WHERE Username ='$username'; ";
            $result = mysqli_query($con,$kundeid) or die(mysqli_error($con));
            //print $kundeid;
            $row = mysqli_fetch_array($result);
            $row_kundeid = $row["Kunde_ID"];
            //print $row_kundeid;
            $sql6 ="INSERT INTO `besitzt` (`Kunde_ID`, `Bankverbindung_ID`) VALUES ('$row_kundeid', '$row_bank_id1');";
            $run_query5 = mysqli_query($con,$sql6);
            //print $run_query5;


}




        if(($run_query1)||($run_query2)){
            echo "
                 <div class='alert alert-success'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                 <b>Sie sind erfolgrei registriert...!</b>
                 </div>
                        ";
        }
    }



?>






















































