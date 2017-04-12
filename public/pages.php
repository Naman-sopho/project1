
<div id="pages">
<?php

// get number of pages

preg_match_all("@pagination@", $resp, $pages);
preg_match_all("@next linkpagination@", $resp, $next_page);
preg_match_all("@prev linkpagination@", $resp, $prev_page);
$no_of_pages = sizeof($pages[0]) - sizeof($next_page[0]) - sizeof($prev_page[0]);

$start = 1;
if (sizeof($prev_page[0]) > 0)
{
	preg_match("@<li class=\" linkpagination\"><a data-page=\"(\d+)@", $resp, $start_page);
	$start = $start_page[1];
}

for ($i = $start; $i <= ($no_of_pages + $start - 1); $i++) 
	render("pages_view.php", ["i" => $i, "city" => $city, "page" => $page, "no_of_pages" => $no_of_pages]);
?>

</div>
