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
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";

if(empty($username)||empty($email)|| empty($f_name) ||empty($l_name) || empty($password) || empty($repassword) || empty($mobile)|| empty($strasse)||empty($hausnummer)||empty($stadt)||empty($plz)){
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
	if(!(strlen($mobile) == 11)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Muss länger als 10 sein</b>
			</div>
		";
		exit();
	}

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
                 VALUES ('$f_name', '$l_name', '$username', '$email',
                              '$password', '$mobile', '$row_add_id');";
        $run_query2 = mysqli_query($con,$sql2);
        //print $sql2;


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






















































