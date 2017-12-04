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
				<a href="#" class="navbar-brand">FoodPorn</a>
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
			<div class="col-md-8" id="regist_nachricht">
				<!--Alert von Registritungsnachricht-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Kunde Registrierung</div>
					<div class="panel-body">
					
					<form method="post">
						<div class="row">
							<div class="col-md-6">
								<label for="f_name">Name</label>
								<input type="text" id="f_name" name="f_name" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="f_name">Vorname</label>
								<input type="text" id="l_name" name="l_name"class="form-control">
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<label for="email">Email</label>
								<input type="text" id="email" name="email"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="password">Password</label>
								<input type="password" id="password" name="password"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="repassword">Password nochmal eingeben</label>
								<input type="password" id="repassword" name="repassword"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="mobile">Telefonnumer</label>
								<input type="text" id="mobile" name="mobile"class="form-control">
							</div>
						</div>
                        <div class="row">
                        <div class="col-md-6">
                            <label for="strasse">Strasse</label>
                            <input type="text" id="strasse" name="strasse" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="hausnummer">Hausnummer</label>
                            <input type="text" id="hausnummer" name="hausnummer"class="form-control">
                        </div>
                        </div>
                            <div class="row">
                        <div class="col-md-6">
                            <label for="stadt">Stadt</label>
                            <input type="text" id="stadt" name="stadt"class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="plz">PLZ</label>
                            <input type="text" id="plz" name="plz"class="form-control">
                        </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="plz">Ohne Bankdaten regestrieren:</label>
                                <input style="float:right;" value="Registrieren" type="button" id="regist1_btn" name="regist1_btn" class="btn btn-primary btn-lg">
                            </div>
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


                        <div class="row" >
                            <div class="col-md-6">
                                <label for="iban">IBAN</label>
                                <input type="text" id="iban" name="iban" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="bic">BIC</label>
                                <input type="text" id="bic" name="bic"class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="kartennumemr">Kartennummer</label>
                                <input type="text" id="kartennumemr" name="kartennumer" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" class="form-control">
                            </div>
                        </div>

                        <p><br/></p>
						<div class="row">
							<div class="col-md-12">
                                <label for="plz">Mit Bankdaten regestrieren:</label>
								<input style="float:right;" value="Registrieren" type="button" id="regist_btn" name="regist_btn" class="btn btn-primary btn-lg">
							</div>
						</div>
						
					</div>
					</form>
					<div class="panel-footer">&copy; 2017 Cananau Cristian&Celac Veronica</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
















