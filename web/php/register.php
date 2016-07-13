<?php

/**
* @Author Paul, Will, Nicholas, Kylee
* @file
* Test file intended for doxygen testing
*/

$credentials = str_getcsv(file_get_contents('credentials.csv'));
//echo '<pre>'; print_r($credentials); echo '</pre>';  //uncomment this line to see the structure of $credentials

$conn = mysqli_connect($credentials[0],$credentials[1],$credentials[2],$credentials[3]);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST['name'])&&!empty($_POST['user'])&&!empty($_POST['address'])){
   $sql = "SELECT * FROM Clients WHERE Business = '$_POST[user]'";
   $res = $conn->query($sql);

   //this is where i get errors
   if($res->num_rows == 0){
   //Convert address to Coordinates
      $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".urlencode($_POST["address"])."&sensor=true";
      $xml = simplexml_load_file($request_url) or die("url not loading");
      $status = $xml->status;
      if ($status=="OK") {
         $lat = $xml->result->geometry->location->lat;
         $long = $xml->result->geometry->location->lng;
      } else {
         echo "Could not parse address into coordinates, please contact the developers.";
         exit();
      }
      $sql_in = "INSERT INTO Clients (Id, Name, Password, Business, Lat, Lon) VALUES (NULL, '$_POST[name]', '$_POST[pass]', '$_POST[user]', '$lat', '$long');";
      echo $sql_in;
      if($conn->query($sql_in) == TRUE){
         header("Location: /");
         exit();
      }else{
         echo "Failed registration, please try again";
         exit();
      }
   }else{
      echo "Username already in use, please register again";
      exit();
   }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title> UAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/styling/index_styling.css" type="text/css"/> 
  </head>
  <body>
    <style type="text/css">
    body { background: #cfcfcf !important; }
    </style> 
<div class = "navbar navbar-inverse navbar-custom" role="navigation">
  <div class="container">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle"
	data-toggle="collapse" data-target=".navbar-collapse">
	   <span class="sr.only">Toggle navigatio</span>
	   <span class="icon-bar"></span>
	   <span class="icon-bar"></span>
	   <span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/">Home</a>
    </div>
    <div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
	   <li><a href="/tracking">Tracking</a></li>
	</ul>
    </div>
    </div>
  </div>
</div>

    
	<div class="container">
		<div class="row main">
         <div class="panel-heading">
            <div class="panel-title text-center">
               <h1 class="title">Register</h1>
               <hr />
            </div>
         <div>
			<div class="main-login main-center">
				<div class="form-horizontal" style="width:75%; margin-left:auto; margin-right:auto;">
               <form method="POST" action="register.php">
					<div class="form-group">
						<label for="name" class="cols-sm-2 control-label">Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="name" id="name" placeholder="Name"></input>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="business" class="cols-sm-2 control-label">Business</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="user" id="user" placeholder="Business name"></input>
							</div>
						</div>
					</div>
			   	<div class="form-group">
						<label for="address" class="cols-sm-2 control-label">Address</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="address" id="address" placeholder="Street name City State Zip"></input>
							</div>
						</div>
   				</div>
					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Password</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="password" class="form-control" name="pass" id="pass" placeholder="Account Password" required></input>
							</div>
						</div>
					</div>
            <div class="form-group ">
                <input id="button" type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Register">
            </div>
            </form>	
            </div>
			</div>
		</div>
	</div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
   $conn->close();
?>
