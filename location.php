<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Event Locator & Viewer</title>

	<style>
	body{
		font-family:arial;
		font-size:.8em;
	}

	input[type=text]{
		padding:0.5em;
		width:20em;
	}

	input[type=submit]{
		padding:0.4em;
	}

	#gmap_canvas{
		width:100%;
		height:30em;
	}

	#map-label,
	#address-examples{
		margin:1em 0;
	}
	</style>

</head>
<body>


	<!-- google map will be shown here -->
	<div id="gmap_canvas">Generate event map canvas. Please Wait.</div>
	<div id='map-label'>Relative event location</div>

	<!-- JavaScript to show google map -->
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyD64oAZBcNecONu1COO3xZr8tnQtqVmaDc"></script>
	<script type="text/javascript">
		function init_map() {
			var myOptions = {
				zoom: 14,
				center: new google.maps.LatLng(56.130366, -106.346771),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
			marker = new google.maps.Marker({
				map: map,
				position: new google.maps.LatLng(56.130366, -106.346771)
			});
			infowindow = new google.maps.InfoWindow({
				content: "Canada"
			});
			google.maps.event.addListener(marker, "click", function () {
				infowindow.open(map, marker);
			});
			infowindow.open(map, marker);
		}
		google.maps.event.addDomListener(window, 'load', init_map);
	</script>

	
<div id='address-examples'>
	<div>Address examples:</div>
	<div>1. 2000 Simcoe Street North, Oshawa, Canada</div>
	<div>2. UOIT</div>
</div>

<!-- enter any address -->
<form action="" method="post">
	<input type='text' name='address' placeholder='Enter your event address here.' />
	<input type='submit' value='Locate Event' />
</form>


</body>

<?php

// function to geocode address, it will return false if unable to geocode address
function geocode($address){

	// url encode the address
	$address = urlencode($address);
	
	// google map geocode api url
	$url = "https://maps.google.com/maps/api/geocode/json?address={$address}&key=AIzaSyD64oAZBcNecONu1COO3xZr8tnQtqVmaDc";

	// get the json response
	$resp_json = file_get_contents($url);
	
	// decode the json
	$resp = json_decode($resp_json, true);

	// response status will be 'OK', if able to geocode given address 
	if($resp['status']='OK'){

		// get the important data
		$lati = $resp['results'][0]['geometry']['location']['lat'];
		$longi = $resp['results'][0]['geometry']['location']['lng'];
		$formatted_address = $resp['results'][0]['formatted_address'];
		
		// verify if data is complete
		if($lati && $longi && $formatted_address){
		
			// put the data in the array
			$data_arr = array();			
			
			array_push(
				$data_arr, 
					$lati, 
					$longi, 
					$formatted_address
				);
			
			return $data_arr;
			
		}else{
			return false;
		}
		
	}else{
		return false;
	}
}
?>

</html>
