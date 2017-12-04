<?php
session_start();
include "db.php";

//if(isset($_SESSION["kid"])){
//    header("location:index.php");
//}

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
    <style>
        @media screen and (max-width:480px){
            #suchen{width:80%;}
            #suchen_btn{width:30%;
                float:right;
                margin-top:-32px;
                margin-right:10px;}
        }
    </style>
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
                <li style="width:300px;left:370px;top:10px;"><input type="text" class="form-control" placeholder="Suchen" id="suchen"></li>
                <li style="top:10px;left:380px;"><button class="btn btn-primary" id="suchen_btn">Suchen</button></li>
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
                                <div id="warenkorb_gericht">
                                <-- ... -->
                            </div>
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
                        <li><a href="meinebestellung.php" style="text-decoration:none; color:blue;">Meine Bestellungen</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>





<!-- Hier ist die Carousel-->
 <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>


    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="image/topangebote.jpg" alt="img1">
            <div class="carousel-caption">
                <h3>Das beste Tagesangebot nur für :</h3>
                <h3> Jetzt schell</h3>
                <div id="get_tagesangebot1" style="position: relative; right: 405px;top: -8px"> </div>
            </div>
        </div>
        <div class="item">
            <img src="image/steak.jpg" style="left: 350px" alt="img2">
            <div class="carousel-caption">
                <h3>Das beste Tagesangebot nur für :</h3>
                <h3> Jetzt schell</h3>
                <div id="get_tagesangebot2" style="position: relative; right: 405px;top: -8px "> </div>

            </div>
        </div>
        <div class="item">
            <img src="image/food.jpg" style="left: 350px" alt="img3">
            <div class="carousel-caption">
                <h3>Das beste Tagesangebot nur für :</h3>
                <h3> Jetzt schell</h3>
                <div id="get_tagesangebot3" style="position: relative; right: 405px;top: -8px"> </div>
            </div>
        </div>
    </div>



    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<p><br/></p>
<p><br/></p>



<div class="col-md-10">
    <div class="row">
        <div class="col-md-12 col-xs-12" id="gericht_nachricht">
        </div>
    </div>

    <div  class="panel panel-primary" style="position: relative; left: 110px;">
        <div class="panel-heading" style="background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#267c99), color-stop(50%,#007299));">Gerichte</div>
        <div class="panel-body">
            <div id="get_gericht">
                <!--Here we get product jquery Ajax Request-->
            </div>
        </div>
        <div class="panel-footer">&copy; 2017 Cananau Cristian&Celac Veronica</div>
        </div>

    </div>
<div class="col-md-1"></div>

</body>
</html>















































