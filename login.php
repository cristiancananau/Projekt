<?php
include "db.php";

session_start();

if(isset($_POST["userLogin"])){
    $username = mysqli_real_escape_string($con, $_POST["userUsername"]);
    $password = ($_POST["userPassword"]);
    $sql ="SELECT kunde_id, name, username, password FROM kunde WHERE username = '$username' AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    if($count == 1){
        $row = mysqli_fetch_array($run_query);
        $_SESSION["kid"] = $row["kunde_id"];
        $_SESSION["username"] = $row["username"];
        echo"hi";
    }else{
        echo "<div class='alert alert-danger';>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Bitte geben einen richtigen Username oder Password ein...!</b>
				</div>";
    }
}
?>