
<?php

function apologize($message)
{
    render("apology.php", ["message" => $message]);
    die();
}


//Redirects user to location, which can be a URL or
//a relative path on the local host.
function redirect($location)
{
    if (headers_sent($file, $line))
    {
        trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
    }

    header("Location: {$location}");
    exit;
}


//Renders view, passing in values.
function render($view, $values = [])
{

    // if view exists, render it

    if (file_exists("../views/{$view}"))
    {

        // extract variables into local scope

        extract($values);
        require ("../views/{$view}");

    }

    // else err

    else
    {
        trigger_error("Invalid view: {$view}", E_USER_ERROR);
    }
}


function database_connect()
{
    $servername = "localhost";
    $dbname = "colleges";
    $username = "admin";
    $password = "123456789";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn)
    {
        apologize("Connection Error: " . mysqli_connect_error());
        die();
    }

    return $conn;
}


function query($conn, $string)
{
    $result = mysqli_query($conn, $string);
    return $result;
}


// converts array to csv format
function str_putcsv($data)
{

    // Generate CSV data from array

    $fh = fopen('php://temp', 'rw');

    // write out the data

    foreach($data as $row)
    {
        fputcsv($fh, $row);
    }

    rewind($fh);
    $csv = stream_get_contents($fh);
    fclose($fh);
    return $csv;
}

// sanitizes user input for html or sql
function sanitize($target, $lang)
{
	$result = "";		
	
	$conn = database_connect();
	if($lang === "sql")
		$result = mysqli_real_escape_string($conn, $target);
	else if($lang === "html")
		$result = htmlspecialchars($target);
	
	return $result;
}

?>

