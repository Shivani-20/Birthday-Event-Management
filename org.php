<?php
require 'config.php';
session_start();
?>

<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<body style="background:url(pump.jpg);background-repeat:no-repeat;background-size:cover;">
  

 <div class="top-container">
  <h1 style="font-family:bold">BOOK HERE!</h1>
  </div>
  <br>
<marquee style="font-family:Forte;font-size:16pt;color:black;"> *******PLEASE FILL IN BOOKING DETAILS!*******</marquee>
 <br>
 <div id="ss">
<center><h2><u>BOOKING FORM</u></h2></center>


<form action="org.php" method="post" class="f3">

<label><b>GUEST_COUNT</b></label>
<br>
<input name="gc" type="number"  class="iv" placeholder="Type number of guests for party" required/><br>
<br>

<label><b>CELEBRANT</b></label>
<br>
<input name="ce" type="text"  class="iv" placeholder="Type name of person whose birthday you want to celebrate" required/><br>
<br>

<br>
<input name="next" type="submit" id="N" value="NEXT"/>


</form>

<?php
if(isset($_POST['next']))
{
	
	
	
	$z=$_POST['gc'];	
	$l=$_SESSION['xx'];
	$u=$_POST['ce'];
	
	$q2="insert into booking values('$l','','$z','$u')";
    $q3=mysqli_query($con,$q2);
		if($q3)
		{
			$query="select B_ID from booking where B_ID=(select max(B_ID) from booking)";
	        $query_run=mysqli_query($con,$query);
			$info=mysqli_fetch_assoc($query_run);
	        $_SESSION['yy']="$info[B_ID]";
			
			$query="select GUEST_COUNT from booking where B_ID=(select max(B_ID) from booking)";
	        $query_run=mysqli_query($con,$query);
			$info=mysqli_fetch_assoc($query_run);
	        $_SESSION['yx']="$info[GUEST_COUNT]";
			
			header('location:lei.php');
        }
    }
	
	
?>

</div>
<br>
<br>
 
 <div>
 <input class="bb1" type="button" onclick="location.href='index.php';" value="LOG_OUT" style="font-size:12pt;"/>
 <input class="bb2" type="button" onclick="location.href='home.php';" value="BACK" style="font-size:12pt;"/>
 </div>
 
</body>
</html>