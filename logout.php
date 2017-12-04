<?php

session_start();

unset($_SESSION["kid"]);

unset($_SESSION["username"]);

header("location:index.php");

?>