<html>

<head>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<?php
// check if a city or a URL is entered
$input = "";
if (filter_var($_POST["input_url"], FILTER_VALIDATE_URL)):
	$input = $_POST["input_url"];
else:
	$input = "http://www.shiksha.com/b-tech/colleges/b-tech-colleges-" . strtolower($_POST["input_url"]);
endif;

// Matching city name and page number
preg_match('/colleges-([a-z]+)$|colleges-([a-z]+)-([\d+])|colleges-([a-z]+)-([a-z]+)$|colleges-([a-z]+)-([a-z]+)-([\d]+)/i', $input, $matches);

$city = "";
$page = 1;

// if a one word city is entered
if (!empty($matches[1])):
{
	$city = ucfirst($matches[1]);
}

// if a one word city + page no. is entered
elseif (!empty($matches[2]) && !empty($matches[3])):
{
	$city = ucfirst($matches[2]);
	$page = $matches[3];
}

// if a two word city is entered
elseif (!empty($matches[4]) && !empty($matches[5])):
{
	$city = ucfirst($matches[4])." ".ucfirst($matches[5]);
}

//if a two word city + page no. is entered
elseif (!empty($matches[6]) && !empty($matches[7]) && !empty($matches[8])):
{
	$city = ucfirst($matches[6])." ".ucfirst($matches[7]);
	$page = $matches[8];
}

// invalid URL entered
else:
{
	echo("<h3>Please enter a valid URL.</h3><br>
		Click <a href=\"index.php\">here</a> to go back.");
	die();
}
endif;
?>

	<script async>
		//Sending POST request to processing.php
		var url = "<?php echo $input ?>";
        var page = "<?php echo $page ?>";
        var city = "<?php echo $city ?>";
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
			<?php echo($city); ?> </h4>
		<img src="img/75.gif" id="loading">
	</div>
</body>

</html>
