<script type="text/javascript">

	var url = "<?php echo $input ?>";
        var page = "<?php echo $page ?>";
  	var city = "<?php echo $city ?>";
	
	$(document).ready(function(){
		//Sending POST request to processing.php
		var posting = $.post("processing.php", {input_url: url, page: page, city: city});

		posting.done(function(data) {
			$("#replace").empty().append(data);
		});
	});

</script>

<div id="replace">
	<h4 id="request">You requested for colleges in
		<?php echo($city); ?> </h4>
	<img src="img/loading.gif" id="loading">
</div>

