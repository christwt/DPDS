<?php
session_start();
/**
* @Author Paul, Will, Nicholas, Kylee
* @file
* Test file intended for doxygen testing
*/


if(isset($_GET['OrderId'])) {

	$senderCoordinates = array(0,0);
	$recieverCoordinates = array(0,0);
	$droneCoordinates = array(0,0);

	$orderId = $_GET["OrderId"];

	$credentials = str_getcsv(file_get_contents('credentials.csv'));
	//echo '<pre>'; print_r($credentials); echo '</pre>';  //uncomment this line to see the structure of $credentials

	$conn = mysqli_connect($credentials[0],$credentials[1],$credentials[2],$credentials[3]);						
	// Check connection
	if ($conn->connect_error) {
		echo "connection error";
		die("Connection failed: " . $conn->connect_error);
	}
	
	//validate the given order id number
	$sql = "SELECT Id FROM Orders WHERE Id=".$orderId.";";
	$result = $conn->query($sql);
	
	
	if ($result->num_rows > 0) {
		// the orderid is valid, show the map	

	//get sender location
	$sql = "SELECT Lat,Lon FROM Clients WHERE Id = (SELECT ClientId FROM Orders WHERE Id=".$orderId.");";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$senderCoordinates[0] = $row["Lat"];
			$senderCoordinates[1] = $row["Lon"];
		}
	} else {
		echo 'Database Error, please contact the developers or click the link below to make sure that OrderId is set in the URL.<br>
		<a href="?OrderId=121114">clientTracking.php?OrderId=121114</a><br><br>
		';
	}

	//get receiver location, drone position, and drone launch time
	$sql = "SELECT Orders.ClientId,Orders.DroneId,Orders.Lat AS RLat,Orders.Lon AS RLon,Drones.lat AS DLat,Drones.Lon AS DLon,Orders.TimeOut,Status.Description AS Status,Status.Id AS StatusID FROM Orders JOIN Drones ON Drones.Id=Orders.DroneId JOIN Status ON Status.Id=Drones.Status WHERE Orders.Id=".$orderId.";";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$recieverCoordinates[0] = $row["RLat"];
			$recieverCoordinates[1] = $row["RLon"];
			$droneCoordinates[0] = $row["DLat"];
			$droneCoordinates[1] = $row["DLon"];
			$droneTimeOut = $row["TimeOut"];
			$droneStatus = $row["Status"];
			$droneStatusID = $row["StatusID"];
		}
	} else {
		echo "Database Error, please contact the developers.";
	}
		
	//calculate ETA: code adapted from http://www.movable-type.co.uk/scripts/latlong.html
	$lon1 = $droneCoordinates[1];
	$lon2 = $recieverCoordinates[1];
	$lat1 = $droneCoordinates[0];
	$lat2 = $recieverCoordinates[0];
	$theta = $lon1 - $lon2;
  	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  	$dist = acos($dist);
 	$dist = rad2deg($dist);
  	$miles = $dist * 60 * 1.1515;
	$time = $miles / 44.7387;


?>
<html>
    <head>
        <title>Tracking</title>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <link href="static/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="trackingstyle.css">
    </head>
    <body>
	<style type="text/css">
	body { background: lightgray !important; }
	</style>
	<div id= 'title'>
     	    <h2>Delivery Status:</h2>Please Click the Drone Icon to view delivery details.
	</div>
	    <div id="map"></div>
    	<script>
			
      		function initMap() {
				
			//set drone coordinates.
			var droneLatLng = ['Delivery Location', <?php 
			echo $droneCoordinates[0].", ".$droneCoordinates[1];?>];
			
			//initialize map
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 9,
				center: {lat: droneLatLng[1], lng: droneLatLng[2]}
			});
				
			// place  custom delivery marker
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
				
			// info window for delivery marker
			var contentstr = '<div id = "content">' + 
				'<div id="deliveryInfo">' + 
				'</div>' + 
				'<h1 id="firstHeading" class="firstHeading">Delivery Info</h1>' +  
				'<p><b>Order ID: </b>' + '<?php echo $orderId?>' + '</p>' +
				'<b>Current Status: </b>' + '<?php echo $droneStatus; ?>' + '</p>' +
				'<b>Flight Speed:</b> 20 meters per second (45 miles per hour)</p>' + 
				'<b>Delivery ETA: </b>' + '<?php
					if ($droneStatusID == 2) {
						if ($time <=0) {
	 						echo "delivery complete.";
						} else if ($time < 1) {
							$time = intval($time * 60);
							echo "estimated $time minutes until arrival.";
						} else {
							$seconds = $time * 3600;
							$hours = floor(($seconds % 86400) / 3600);
							$minutes = floor(($seconds % 3600) / 60);
							echo "estimated $hours hours $minutes minutes until arrival.";
						}
					} else {
						echo "Order has not shipped yet.";
					}
				?>' + '</p>' +  
				'</div>' + 
				'</div>';

			var infowindow = new google.maps.InfoWindow({
				content: contentstr
			}); 
				
			// listener to open info window.
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			});


			// call to set remaining markers
			setMarkers(map);
			
			// listener to recenter map with marker bounds after closing info window.
			google.maps.event.addListener(infowindow, 'closeclick', function() {
				setMarkers(map);
                                map.panToBounds(bounds);

                        });
			
			// listener to reset map if off_center after 20  seconds. 
			map.addListener('center_changed', function() {
				window.setTimeout(function() {
					setMarkers(map);
				}, 20000);
			});     
                        				
			// map styling
			var styles = [
				{
				featureType: "all",
				stylers: [
					{ saturation: -80 }
				]
				},{
				featureType: "road.highway",
				elementType: "geometry",
				stylers: [
					{ hue: "00ffee" },
					{ saturation: 50 }
					]
				}
				];
			// comment below to return to default ROADMAP styling.
			map.setOptions( {styles: styles});
			}	
			
			var coords = [
				['Sender Location', <?php echo $senderCoordinates[0].", ".$senderCoordinates[1]; ?>, 2, 'https://cdn1.iconfinder.com/data/icons/buildings-landmarks-set-2/96/Post-Office-512.png'],
				['Reciever Location', <?php echo $recieverCoordinates[0].", ".$recieverCoordinates[1]; ?>, 3, 'http://simpleicon.com/wp-content/uploads/home-5.png'] 
			];
			
			// set sender/reciever lat/long markers
			function setMarkers(map) {
				
				var bounds = new google.maps.LatLngBounds();

				for (var i = 0; i < coords.length; i++) {
					var coord = coords[i];

					var image = {
                                        url: coord[4],
                                        scaledSize: new google.maps.Size(25,25)
                                	};	

					var marker = new google.maps.Marker({
						position: {lat: coord[1], lng: coord[2]},
						map: map,
						icon: image,
						title: coord[0],
						zIndex: coord[3]
					});
					
					bounds.extend(marker.position);				
				}
				// fit zoom map to fit all markers.
				map.fitBounds(bounds);
			}
		
    	</script>
    	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9yKxAbb4cH2ZJ_D3EWp3sG-DHJLxLURI&callback=initMap"
        async defer></script>
<?php

	} else { ?>
		<h1>Invalid Order ID.  Try again.</h1>
<?php
	}
}
?>
	<div class="tracking">
		<style type="text/css">
			div.tracking {        
				text-align: center;
        			font-family: "Lucida Console", Lucida, Monospace;
				margin: 25px;
 			};
		</style>
		<form action="" method="get">
			<h4>Enter an order number to track your delivery.</h4>
			Order number:
			<input type="text" name="OrderId">
			<input type="submit" name="submit">
		</form>
	</div>
	<div class="container">
		<style type="text/css">
			div.container { 
				font-family: "Lucida Console", Lucida, Monospace;
				text-align: center;
				margin-right: auto;
				margin-left: auto;
			};
		</style>
        <?php
            if(isset($_SESSION['ClientID'])){
               $url = "/clientHome.php"; // This should not be redirecting to index.php because this line only executes when the user is already logged in.
            }else{
               $url = "/";
            }
            echo "<p>Click <a href='$url'>here</a> to go home.</p>";
         ?>
        </div>

    </body>
<html>
<?php
$conn->close();
?>
