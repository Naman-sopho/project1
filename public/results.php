<?php
// Matching city name and page number
preg_match('/colleges-([^-]+)-([^-]+)/i', $_POST["input_url"], $matches);
$matches[1] = ucfirst($matches[1]);
?>
<html>

<head>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script async>
		//Sending POST request to processing.php
		var url = "<?php echo $_POST["input_url"] ?>";
        var page = "<?php echo $matches[2]?>";
        var city = "<?php echo $matches[1]?>";
        var posting = $.post("processing.php", {input_url: url, page: page, city: city});
        posting.done(function(data) {
            $("#replace").empty().append(data);
			$("#loading").fadeOut();
			$("#request").fadeOut();
		});
    </script>
</head>

<body>
	<div id="replace">
		<h4 id="request">You requested for colleges in
			<?php echo($matches[1]); ?> </h4>
		<img src="img/75.gif" id="loading">
	</div>
</body>

</html>
