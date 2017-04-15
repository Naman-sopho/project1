
<?php
require ("../includes/helpers.php");

render("../views/header.php", ["title" => "|College Search"]);
?>
</div>
<div class="form">
	<script>
		window.onload = function() {
			document.getElementById("url").focus();
		};
	</script>
	<form action="results.php" method="POST">
		<fieldset>
			<legend><span class="search">.</span>Search Colleges</legend>
			<input id="url" type="text" name="input_url"  placeholder= "Enter the URL or City name"></input><br />
		</fieldset>
		<input type="submit" value="Submit"></input>
	</form>
</div>
<?php
render("../views/footer.php");
?>

