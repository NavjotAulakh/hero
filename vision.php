<!DOCTYPE html>
<html>
<head>
	<title>Event Document Text Analyzer</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body ng-app="ocrApp" ng-controller="ocrController">
	<a href="https://eventprompter.herokuapp.com/index.php">Event - Main Page</a>
	<canvas id="uploadedPic">  Image Results	</canvas>
	<p>
		<input type="file" onchange="angular.element(this).scope().uploadPicture( this)">
	</p>
	<p>
		<textarea id="result" cols="100" rows="5">{{ result }}</textarea>
	</p>
</body>
<script type="text/javascript" src="app.js"></script>
</html>
