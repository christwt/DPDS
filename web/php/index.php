<?php

/**
* @Author Paul, Will, Nicholas, Kylee
* @file
* Test file intended for doxygen testing
*/

session_start();

$credentials = str_getcsv(file_get_contents('credentials.csv'));
$conn = mysqli_connect($credentials[0],$credentials[1],$credentials[2],$credentials[3]);

if ($conn->connect_error) {   //get connection
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST['user'])){
   $sql = "SELECT Id FROM Clients WHERE Business='$_POST[user]'AND Password ='$_POST[pass]' LIMIT 1"; //sql query

   $res = $conn->query($sql);
   if($res->num_rows==1){
      $row = $res->fetch_assoc();
      $_SESSION["ClientID"]=$row["Id"];
      header("Location: /clientHome.php");
      exit();
   }else{
      $_SESSION['Error'] = TRUE;
   //   header("Location: /");
   }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> UAS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/styling/index_styling.css" type="text/css"/> 
  </head>
  <body>
  <style type="text/css">
    body { background: #c0c0c0 !important; }
    </style>    
<div class = "navbar navbar-inverse navbar-custom" role="navigation">
  <div class="container">
    <div class="navbar-header">
   <button type="button" class="navbar-toggle"
   data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr.only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
   </button>
   <a class="navbar-brand" href="/">Home</a>
    </div>
    <div class="navbar-collapse">
   <ul class="nav navbar-nav">
      <li><a href="/tracking_v2.php">Tracking</a></li>
   </ul>
    </div>
    </div>
  </div>
</div>

 
<div class="container">
   <div class="page-header">
     <h1 class="text-center">Welcome to DPDS</h1>
   </div>
   <div class="container">
      <div class="row-main">
         <div class="panel-heading">
            <div class = "panel-title text-center">
               <h1 class="title">Log In</h1>
               <hr />
            </div>
         </div>
         <div class="main-login main-center" style="width:75%; margin-left:auto; margin-right:auto;">
            <div class="form-horizontal">
               <form method="POST" action="index.php">
                  <div class="form-group">
                     <label for="user" class="cols-sm-2 control-label">Name</label>
                     <div class="cols-sm-10">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                          <input type="text" class="form-control" name="user" placeholder="Business Name"><br></input>
                        </div>
                     </div>
                  </div>         
                  <div class="form-group">
                     <label for="password" class="cols-sm-2 control-label">Password</label>
                     <div class="cols-sm-10">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                           <input type="password" class="form-control" name="pass" id="pass" placeholder="Account Password"></input>
                        </div>
                     </div>
                  </div>
                 <div class="form-group ">
                     <input id="button" type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Login">
                  </div>
                  <div id = "Error">
                  <?php if($_SESSION['Error']){
                     echo "Unsuccessful log in, please try again";
                     $_SESSION['Error'] = FALSE;
                  } ?>
                  </div>
 
                 <div class="login-register">
                        <li> <a href="/register.php">Register</a></li>
                  </div>

               </form>
            </div>
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
