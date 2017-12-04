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
    <!--<meta http-equiv="refresh" content="5"> refresh alle 5 sekunden-->
    <title>PornoFood</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" style="background-color: #000212; border-color: #f4e6f5;>
    <div class="container-fluid">
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
        <span class="sr-only">navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a href="#" class="navbar-brand">FoodPorn</a>
</div>
<style>
    .btn-primary{
        background: -moz-linear-gradient(top,  #267c99 50%, #007299 50%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#267c99), color-stop(50%,#007299)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #267c99 50%,#007299 50%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #267c99 50%,#007299 50%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #267c99 50%,#007299 50%); /* IE10+ */
        background: linear-gradient(to bottom,  #267c99 50%,#007299 50%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#267c99', endColorstr='#007299',GradientType=0 );}
</style>
<div class="collapse navbar-collapse" id="collapse">
    <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li>

        </li>
        <li><a href="#" class="dropdown-toggle"  style="position:relative; right: 30px;><span class="glyphicon glyphicon-user"></span> <?php echo "Hi,".$_SESSION ["username"] ?> </a>
        </li>

    </ul>
</div>
</div>
</div>

<p><br/></p>
<p><br/></p>
<p><br/></p>
<div class="col-md-10" id="bestellung_msg" style="position: relative; left: 150px">
    <!--Status MSG-->
</div>

<div class="container-fluid">
    <div class="row" style="position: relative; left: 150px">
        <div class="col-md-2" ></div>
        <div class="col-md-10">
            <div class="panel panel-primary">

                <div class="panel-heading" style="background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#267c99), color-stop(50%,#007299));">Bestellungen</div>
                <div class="panel-body">
                    <div class="row" style="position: relative; left: 90px">
                        <div class="col-md-1 col-xs-1"><b>Ware Nr.</b></div>
                        <div class="col-md-2 col-xs-2"><b>Gericht Name</b></div>
                        <div class="col-md-1 col-xs-1"><b>Menge</b></div>
                        <div class="col-md-1 col-xs-1"><b>Kunde</b></div>
                        <div class="col-md-2 col-xs-2" style="position: relative; left: 40px"><b>Bestelldatum</b></div>
                        <div class="col-md-1 col-xs-1"><b>Preis in €</b></div>
                        <div class="col-md-1 col-xs-1"><b>Status</b></div>
                        <div class="col-md-2 col-xs-2"><b>in.Bea|unter|wur.zu</b></div>
                    </div>
                    <div id="bestellung_admin" style="position: relative; left: 90px"></div>
                    <!-- Bestellungen -->
                </div>
                <p><br/></p>

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
