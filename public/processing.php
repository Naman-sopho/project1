<?php
// constants
$servername = "localhost";
$username = "admin";
$password = "123456789";
$dbname = "colleges";
$city = $_POST["city"];
$page = $_POST["page"];
$url = $_POST["input_url"];


$curl = curl_init();
//Setting options for request
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $_POST["input_url"],
	CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.112 Safari/534.30"
));

//Sending request and saving response as a string
$resp = curl_exec($curl);

//Check for errors in curl req
if (!$resp):
	die("Error:" . curl_error($curl) . "Error-Code:" . curl_errno($curl));

else:
	//Close request
	curl_close($curl);

endif;

// scraping data
$regex = "@(<h2 class=\"tuple-clg-heading\">[\w\W]+)(?:<p class=\"clr\"></p>)@iU";
preg_match_all($regex, $resp, $matches);

// converts array to csv format
function str_putcsv($data) {
	// Generate CSV data from array
    $fh = fopen('php://temp', 'rw');

    // write out the data
	foreach ( $data as $row ) 
	{
    	fputcsv($fh, $row);
    }
    rewind($fh);
    $csv = stream_get_contents($fh);
    fclose($fh);

    return $csv;
}

$names = array();
$places = array();
$reviews = array();
$facilities = array();
$csv = "";

foreach($matches[1] as $match)
{
	$regex_name = "@<h2 class=\"tuple-clg-heading\">[0-9?&_<a-z\s=\":/.-]+>(.*)</a>@i";
	preg_match($regex_name, $match, $name);
	$names[] = $name[1];

	$regex_place = "@<p>\|\s([a-z,\s]+)</p>@i";
	preg_match($regex_place, $match, $place);
	$places[] = $place[1];

	$regex_facilities = "@<div class=\"srpHoverCntnt2\">\\n<h3>(.*)</h3>@i";
	preg_match_all($regex_facilities, $match, $facilities_match);
	
	// remove first element in match if array is non empty
	if (array_shift($facilities_match)):
	{	
		$csv = str_putcsv($facilities_match);
		$facilities[] = $csv;
	}

	else:
		$facilities[] = "";

	endif;

	$regex_reviews = "@<span><b>(.*)</b>@i";
	preg_match($regex_reviews, $match, $reviews_match);
	
	// insert into reviews array
	if (!empty($reviews_match[1])):
		$reviews[] = $reviews_match[1];
	else:
		$reviews[] = 0;
	endif;
}

// connect to database
$conn = mysqli_connect($servername, $username, $password, $dbname);
// check for successfull connection
if (!$conn)
	die("Connection Error: ". mysqli_connect_error());

// populate database
for($i = 0; $i < sizeof($names); $i++)
{
	$name = $names[$i];
	$place = $places[$i];
	$facility = htmlspecialchars($facilities[$i]);
	$review = $reviews[$i];

	// insert only if college not already present
	$check = "SELECT * FROM colleges WHERE name='".$name."' AND place='".$place."'";
	$result = mysqli_query($conn, $check);
	if(mysqli_num_rows($result) == 0):
	{
		$sql = "INSERT INTO colleges VALUES ('".$city."', '".$page."', '".$name."', '".$place."', '".$facility."', '".$review."')";
		mysqli_query($conn, $sql);
	}

	// else update number of reviews and facilities(only they are liable to change)
	else:
	{
		$sql = "UPDATE colleges SET facilities='".$facility."' reviews='".$review."' WHERE name='".$name."' AND place='".$place."'";
		mysqli_query($conn, $sql);
	}
	endif;
}

// render colleges table
require("table.php");

// close connection
mysqli_close($conn);

?>
