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
        <li><a href="#"  id="warenkorb_inhalt" class="dropdown-toggle" data-toggle="dropdown" style="position:relative; right: 30px;"><span class="glyphicon glyphicon-shopping-cart"></span>Warenkorb<span class="badge"></span></a>
            <div class="dropdown-menu" style="width:400px;">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-3">Nr.</div>
                            <div class="col-md-3">Product Image</div>
                            <div class="col-md-3">Product Name</div>
                            <div class="col-md-3">Price in €</div>
                        </div>
                    </div>
                    <div class="panel-body">

                    </div>

                </div>
            </div>
        </li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" style="position:relative; right: 30px;><span class="glyphicon glyphicon-user"></span> <?php echo "Hi,".$_SESSION ["username"] ?> </a>
            <ul class="dropdown-menu">
                <li><a href="warenkorb.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Warenkorb</a></li>
                <li class="divider"></li>
                <li><a href="user_profile.php" style="text-decoration:none; color:blue;">User Profile</a></li>
                <li class="divider"></li>
                <li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
            </ul>
        </li>

    </ul>
</div>
</div>
</div>

<p><br/></p>
<p><br/></p>
<p><br/></p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-primary">

                        <div class="panel-heading" style="background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#267c99), color-stop(50%,#007299));">Bestellungen</div>
                        <div class="panel-body">
                            <div class="row" style="position: relative; left: 150px">
                                <div class="col-md-1 col-xs-1"><b>Ware Nr.</b></div>
                                <div class="col-md-2 col-xs-2"><b>Gericht Name</b></div>
                                <div class="col-md-1 col-xs-1"><b>Menge</b></div>
                                <div class="col-md-2 col-xs-2" style="position: relative; left: 40px"><b>Bestelldatum</b></div>
                                <div class="col-md-2 col-xs-2"><b>Preis in €</b></div>
                                <div class="col-md-2 col-xs-2" style="position: relative; right: 40px"><b>Status</b></div>
                            </div>
                            <div id="bestellung_information" style="position: relative; left: 170px"></div>
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


