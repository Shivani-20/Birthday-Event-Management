<!DOCTYPE html>
<html>
<head>
<style>
* {box-sizing: border-box;}

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
#N
{
background-color:#ff793f;
	padding:5px;
	color:black;
	margin:auto;
	width:435px;
	font-family:Arial;
	font-size:18px;
	
}
.iv
{
	width:435px;
	margin:0 auto;
	padding:5px;
}

</style>
</head>

<body style="background-color:white;">


 
<div id="ss">
<center><h2><u>Click on submit to delete all the booking for today.</u></h2></center>


<form action="adm2.php" method="post" class="f3">



<br>
<input name="submit" type="submit" id="N" value="SUBMIT"/>
</form>
<?php
if(isset($_POST['submit']))
{
$con=new PDO("mysql:host=localhost;dbname=birthday",'root','');
$sql="CALL ClearHistory()";
$res=$con->prepare($sql);
$res->setFetchMode(PDO::FETCH_ASSOC);
$res->execute();
echo '<script type="text/javascript"> alert("All events deleted from record that took place today") </script>';
header('location:index.php');
}
?>
</div>
</body>
</html>