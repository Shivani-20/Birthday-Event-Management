<?php
require 'config.php';
$re = mysqli_query($con,"SELECT * FROM result");

echo "<table border='1'>
<tr>
<th>c_id</th>
<th>b_id</th>
<th>total_amount</th>
</tr>";

while($row = mysqli_fetch_array($re))
{
echo "<tr>";
echo "<td>" . $row['c_id'] . "</td>";
echo "<td>" . $row['b_id'] . "</td>";
echo "<td>" . $row['total_amount'] . "</td>";
echo "</tr>";
}


echo "</table>";
$re1 = mysqli_query($con,"delete from result");


?>