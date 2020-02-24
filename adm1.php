<!doctype html>
<html>
<body>
<head>
<style>
* {box-sizing: border-box;}

#N
{
	
background-color:#ff793f;
	padding:5px;
	color:black;
	margin:auto;
	width:430px;
	font-family:Arial;
	font-size:18px;
	
}
.iv
{
	width:430px;
	margin:0 auto;
	padding:5px;
	
	
}
#ss
{
	width:500px;
	float:center;
	background:#227093;
	padding:5px;
	font-family:Arial;
	margin:0 auto;
	height:100px;
}

.f3
{
	width:450px;
	margin:0 auto;
}
</style>
</head>

<div id="ss">
<center><h2><u>Enter the date for which you need the event details!!</u></h2></center>
<form action="adm1.php" method="post" class="f3">
<br>
<input name="date" type="date"  class="iv" placeholder="select date of event" required/>
<br>
<input name="submit" type="submit" id="N" value="SUBMIT"/>
</form>
</div>
</body>
</html>

<?php
$con=mysqli_connect("localhost","root","","birthday");
if(isset($_POST["submit"]))
{
$sql="CALL getData('".$_POST["date"]."')";
if(mysqli_query($con,$sql))
{
	header('location:res.php');
}
}
?>