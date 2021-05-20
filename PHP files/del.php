<?php
$con=mysqli_connect("localhost","root","","birthday");
if(!$con)
{
    die("unable to connect".mysqli_connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
#deletee
{
	width:200px;
	float:center;
	background:#f7f1e3;
	padding:5px;
	font-family:Algerian;
	height:200px;
}
.fff
{
	width:150px;
	margin:0 auto;
}



</style>
</head>
<body style="background:url(bb.jpg);">
<div id="deletee">
<form action="del.php" method="post" class="fff">
<br>
<label><b>Booking_id</b></label>
<input name="bid" type="number" placeholder="type the booking id" />
<br>
<br>
<label><b>Celebrant</b></label>
<input name="noc" type="text" placeholder="type the name of person whose birthday should be cancelled" />
<br>
<br>
<input name="de" type="submit" id="d" value="delete"/>
</form>
<?php

if(isset($_POST['de']))
{
	$a=$_POST['bid'];
	$b=$_POST['noc'];
	$q1="select CELEBRANT from booking where CELEBRANT='$b' AND B_ID='$a'";
	  $q4=mysqli_query($con,$q1);
	if(mysqli_num_rows($q4)>0)
		{
	$q2="delete from booking where B_ID='$a'";
        $q3=mysqli_query($con,$q2);
		if($q3)
		{
			echo '<script type="text/javascript"> alert("Event cancelled") </script>';
           
	    }
		}
		else
		{
			echo '<script type="text/javascript"> alert("either booking_id is wrong or celebrant!") </script>';
		}
		
	
}
?>
</div>
</body>
</html>