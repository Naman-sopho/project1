<?php
$query = "SELECT * FROM colleges WHERE city='{$city}' AND page_no='{$page}'";
$result = mysqli_query($conn, $query);

// check if query returned any rows
if (mysqli_num_rows($result) == 0)
{
	echo "<h2>Sorry!!!</h2><br><h3>No colleges to show</h3>";
	die();
}
?>

<h3>Colleges in <?= $city ?></h3>

<table>
	<tr>
		<td><em><strong>Serial No.</td>
		<td><em><strong>College&nbsp;Name</td>
		<td><em><strong>Location</td>
		<td><em><strong>Number of reviews</td>
		<td><em><strong>Facilities offered</td>
	</tr>

<?php
$i = 1;
foreach($result as $row):
?>
	<tr>
		<td><?= $i ?></td>
		<td><?= $row["name"] ?></td>
		<td><?= $row["place"] ?></td>
		<td><?= $row["reviews"] ?></td>
		<td>
			<?php
   				$i++;	
				$explode = explode(',', $row["facilities"]);
				echo "<ul>";
				foreach($explode as $facility)
					echo "<li>".$facility."</li>";
			?>
			</ul>
		</td>
	</tr>
<?php
endforeach;
?>

</table>
