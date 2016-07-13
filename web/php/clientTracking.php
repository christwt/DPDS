<?php

/**
* @Author Paul, Will, Nicholas, Kylee
* @file
* Test file intended for doxygen testing
*/

$senderCoordinates = array(0,0);  // order lat, lon
$recieverCoordinates = array(0,0);

$orderId = $_GET["OrderId"];

$credentials = str_getcsv(file_get_contents('credentials.csv'));
//echo '<pre>'; print_r($credentials); echo '</pre>';  //uncomment this line to see the structure of $credentials

$conn = mysqli_connect($credentials[0],$credentials[1],$credentials[2],$credentials[3]);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//get sender location
$sql = "SELECT SenderLat,SenderLong from Clients WHERE Id = (SELECT ClientId FROM Orders WHERE OrderID=".$orderId.");";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$senderCoordinates[0] = $row["SenderLat"];
		$senderCoordinates[1] = $row["SenderLong"];
	}
} else {
	echo 'Database Error, please contact the developers or click the link below to make sure that OrderId is set in the URL.<br>
	<a href="?OrderId=121114">clientTracking.php?OrderId=121114</a><br><br>
	';
}

//get reciever location
$sql = "SELECT RecieverLat,RecieverLong FROM Orders WHERE OrderID=".$orderId.";";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$recieverCoordinates[0] = $row["RecieverLat"];
		$recieverCoordinates[1] = $row["RecieverLong"];
	}
} else {
	echo "Database Error, please contact the developers.";
}
?>
<html>
    <head>
        <title>Tracking</title>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <link href="static/bootstrap.min.css" rel="stylesheet" media="screen">
	<style>
      		#map {
        		width: 600px;
        		height: 500px;
     		 }
   	 </style>
    </head>
    <body>
	<h2>Drone Tracking Page</h2>
	<h3>Click <a href="/tracking_v2.php">here</a> for an updated version of this page.</h3>
	<div id="map"></div>
    	<script>
			
      		function initMap() {
				
				var droneLatLng = ['Delivery Location', <?php 
				//echo $senderCoordinates[0].", ".$senderCoordinates[1];
				echo "39.7555, -105.2211"   
				?>];
			
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 9,
					center: {lat: droneLatLng[1], lng: droneLatLng[2]}
				});
				
				var drone = {
				url:'https://cdn2.iconfinder.com/data/icons/modern-future-technology/128/drone-128.png',
				scaledSize: new google.maps.Size(25,25)
				};
				
				var marker = new google.maps.Marker({
					position: {lat: droneLatLng[1], lng: droneLatLng[2]},
					map: map,
					icon: drone,
					title: droneLatLng[0]
				});
				
				setMarkers(map);
			}	
			
			//var coords = [
			//	['Sender Location', 40.0150, -105.2705, 2],
			//	['Reciever Location', 39.7047, -105.0814, 3] 
			//];
			
			var coords = [
				['Sender Location', <?php echo $senderCoordinates[0].", ".$senderCoordinates[1]; ?>, 2],
				['Reciever Location', <?php echo $recieverCoordinates[0].", ".$recieverCoordinates[1]; ?>, 3] 
			];
				
			function setMarkers(map) {
				
				var image = {
					url: 'https://cdn1.iconfinder.com/data/icons/buildings-landmarks-set-2/96/Post-Office-512.png',
					scaledSize: new google.maps.Size(25,25)
				};
				for (var i = 0; i < coords.length; i++) {
					var coord = coords[i];
					
					var marker = new google.maps.Marker({
						position: {lat: coord[1], lng: coord[2]},
						map: map,
						icon: image,
						title: coord[0],
						zIndex: coord[3]
					});
				
				}
			}
		
    	</script>
    	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9yKxAbb4cH2ZJ_D3EWp3sG-DHJLxLURI&callback=initMap"
        async defer></script>
	<div class="tracking">
		<form action="" method="get">
			<h3>Enter information to see the drone location</h3>
			Tracking number:<br>
			<input type="text" name="OrderId">
			<input type="submit">
		</form>
	</div>
        <div class="container">
        	<p>Click <a href="/">here</a> to go home.</p>
        <div>
    </body>
<html>
<?php
$conn->close();
?>
