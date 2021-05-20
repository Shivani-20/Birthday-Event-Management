<?php
include 'bill.php';
?>

<?php
$con=mysqli_connect("localhost","root","","birthday");
if(!$con)
{
    die("unable to connect".mysqli_connect_error);
}

?>
<?php

$ll=$_SESSION['yy'];

$query="select total_amount from payment where b_id='$ll'";
$query_run=mysqli_query($con,$query);
$info=mysqli_fetch_assoc($query_run);
$_SESSION['rr']="$info[total_amount]";
$rr=$_SESSION['rr'];

$query="select date_of_booking from payment where b_id='$ll'";
$query_run=mysqli_query($con,$query);
$info=mysqli_fetch_assoc($query_run);
$_SESSION['rl']="$info[date_of_booking]";
$rp=$_SESSION['rl'];




echo "Booking_id:<br>";
echo "$ll.<br>";
echo "<br>";
echo "Amount to be paid after discount:<br>";
echo "$rr.<br>";
echo "<br>";
echo "Date_of_booking:<br>";
echo "$rp.<br>";

?>