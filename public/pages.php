<?php
// get number of pages
preg_match_all("@pagination@", $resp, $pages);
$no_of_pages = sizeof($pages[0]) - 1;

for($i=1; $i <= $no_of_pages; $i++):
?>

<button class="pageLink" id="page<?php echo $i; ?>">Page <?php echo $i; ?></button>&nbsp;

<script type="text/javascript">
	if(<?php echo $i; ?> == <?php echo $page; ?>)
		$("#page<?php echo $i; ?>").toggleClass("activePage");	

	$("#page<?php echo $i; ?>").click(function(e){
		
		var url="<?php echo "http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".$city."-".$i ?>"
		var posting = $.post("results.php", {input_url: url});
		posting.done(function(data) {
			$("#page<?php echo $i; ?>").toggleClass("activePage");
			$("#replace").empty().append(data);
		});
	});
</script>

<?php endfor; ?>


