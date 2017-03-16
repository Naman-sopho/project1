
<?php
require ("../includes/helpers.php");

render("../views/header.php", ["title" => "|College Search"]);
?>
<form action="results.php" method="POST">
	<input type="text" name="input_url"  placeholder= "Enter the URL or City name"></input><br />
	<input type="submit" value="Submit"></input>
</form>
<?php
render("../views/footer.php");
?>

