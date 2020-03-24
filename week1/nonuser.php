<?php
require_once('pdo.php');
	$stmt=$pdo->query("SELECT * FROM profile");
	$count = $stmt->rowCount();
	if ($count>0) {
	echo "<table border=\"1\">
	<tr><th>Name</th><th>Headline</th><tr>";
}
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	echo "<td>"."<a href=\"view.php?profile_id=".$row['profile_id']."\">".$row['first_name'].$row['last_name']."</a></td>";
	echo "<td>".$row['headline']." "."</td>";
	echo '<td></td>';
	echo "</tr>";
}	echo "</table>";


