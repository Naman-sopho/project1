<?php
$query = "SELECT * FROM colleges WHERE city='{$city}' AND page_no='{$page}'";
$result = query($conn, $query);

// check if query returned any rows
if (mysqli_num_rows($result) == 0)
{
	echo "<h2>Sorry!!!</h2><br><h3>No colleges to show</h3>";
	die();
}
?>

<h3>Colleges in <?= $city ?></h3>

<table cellspacing='0'>
	<thead>
		<tr>
			<th><em><strong>Serial No.</th>
			<th><em><strong>College&nbsp;Name</th>
			<th><em><strong>Location</th>
			<th><em><strong>Number of reviews</th>
			<th><em><strong>Facilities offered</th>
		</tr>
	</thead>
	<tbody>
<?php
$i = 1;
foreach($result as $row):
?>
<tr <? if($i%2 == 0) echo "class=\"even\""; ?> >
		<td><?= $i ?></td>
		<td><?= $row["name"] ?></td>
		<td><?= $row["place"] ?></td>
		<td><?= $row["reviews"] ?></td>
		<td>
			<?php
   				$i++;	
				if (!empty($row["facilities"]))
				{
					$explode = explode(',', $row["facilities"]);
					echo "<ul>";
					foreach($explode as $facility)
						echo "<li>".$facility."</li>";
					echo "</ul>";
				}		

				else
				{
					echo "No facilities to display";
				}
			?>
		</td>
	</tr>
<?php
endforeach;
?>
	</tbody>
</table>
<br>
