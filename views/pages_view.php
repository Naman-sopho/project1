<button class="pageLink" id="page<?php echo $i; ?>">Page <?php echo $i; ?></button>&nbsp;

<script type="text/javascript">
	if(<?php echo $i; ?> == <?php echo $page; ?>)
		$("#page<?php echo $i; ?>").toggleClass("activePage");	

	$("#page<?php echo $i; ?>").click(function(e){

		var url="<?php echo "http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".strtolower($city)."-".$i ?>"
		var posting = $.post("results.php", {input_url: url});
		posting.done(function(data) {
			$("#page<?php echo $i; ?>").toggleClass("activePage");
			$("#replace").empty().append(data);
		});
	});
</script>
