<?php
require 'config.php';
$re = mysqli_query($con,"SELECT * FROM result");

echo "<table border='1'>
<tr>
<th bgcolor='yellow'>customer_name</th>
<th bgcolor='yellow'>phone no</th>
<th bgcolor='yellow'>booking id</th>
<th bgcolor='yellow'>guest count</th>

<th bgcolor='yellow'>game</th>
<th bgcolor='yellow'>photography</th>
<th bgcolor='yellow'>video</th>
<th bgcolor='yellow'>audio</th>

<th bgcolor='yellow'>flavour</th>
<th bgcolor='yellow'>theme</th>
<th bgcolor='yellow'>layers</th>
<th bgcolor='yellow'>venue name</th>

<th bgcolor='yellow'>venue theme</th>
<th bgcolor='yellow'>main course</th>
<th bgcolor='yellow'>snacks</th>
<th bgcolor='yellow'>desert</th>
<th bgcolor='yellow'>total amount</th>
</tr>";

while($row = mysqli_fetch_array($re))
{
echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['phone_no'] . "</td>";
echo "<td>" . $row['b_id'] . "</td>";
echo "<td>" . $row['guest_count'] . "</td>";
echo "<td>" . $row['game'] . "</td>";

echo "<td>" . $row['photography'] . "</td>";
echo "<td>" . $row['video'] . "</td>";
echo "<td>" . $row['audio'] . "</td>";
echo "<td>" . $row['flavour'] . "</td>";

echo "<td>" . $row['theme'] . "</td>";
echo "<td>" . $row['layers'] . "</td>";
echo "<td>" . $row['venue_name'] . "</td>";
echo "<td>" . $row['venue_theme'] . "</td>";

echo "<td>" . $row['main_course'] . "</td>";
echo "<td>" . $row['snacks'] . "</td>";
echo "<td>" . $row['desert'] . "</td>";
echo "<td>" . $row['total_amount'] . "</td>";
echo "</tr>";
}


echo "</table>";
$re1 = mysqli_query($con,"delete from result");


?>