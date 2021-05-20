<?php
$con=mysqli_connect("localhost","root","","birthday");
if(!$con)
{
    die("unable to connect".mysqli_connect_error);
}
session_start();
?>

<!DOCTYPE html>
<html>

<head>
<style>
* {box-sizing: border-box;}
#maa
{
	width:500px;
	float:left;
	background:#f7f1e3;
	padding:5px;
	font-family:Algerian;
	height:300px;
	
}
.f
{	
	width:450px;
	margin:0 auto;
}

	.inputvalues
{
	width:430px;
	margin:0 auto;
	padding:5px;
}



#l
{
	background-color:#2c3e50;
	padding:5px;
	color:white;
	margin:auto;
	width:445px;
	font-family:Algerian;
	font-size:18px;
}
.top-container {
  background-color:#192a56;
  padding: 20px;
  text-align: center;
  color:#e1b12c;
}
	
	

</style>
</head>

<body style="background:url(bb.jpg);">
<div class="top-container">
  <h1 style="font-family:Helvetica">WELCOME OWNERS</h1>
  </div>
  <br>
<marquee style="font-family:Forte;font-size:16pt;color:white;">*******please login ADMIN*******</marquee>
<br>

<div id="maa">
<center><h2><u>login-form</u></h2></center>


<form action="adm.php" method="post" class="f">

<label><b>Admin_id</b></label>
<br>
<input name="uid" type="text" class="inputvalues" placeholder="type your admin_id" />
<br>

<label><b>Password</b></label>
<br>
<input name="pd" type="password" class="inputvalues" placeholder="type your password"/><br>
<br>

<input name="id1" type="submit" id="l" value="DISPLAY"/>

<input name="id2" type="submit" id="l" value="DELETE"/>


</form>

<?php
if(isset($_POST['id1']))
{
	$x=$_POST['uid'];
	$y=$_POST['pd'];
	$query="select * from owners where admin_id='$x' AND admin_password='$y'";
	$query_run=mysqli_query($con,$query);
	
	if(mysqli_num_rows($query_run)>0)
	{
		header('location:adm1.php');
	}
	else
	{
		echo '<script type="text/javascript"> alert("Sorry you are not one of the admins") </script>';
	}
}
if(isset($_POST['id2']))
{
	$x=$_POST['uid'];
	$y=$_POST['pd'];
	$query="select * from owners where admin_id='$x' AND admin_password='$y'";
	$query_run=mysqli_query($con,$query);
	
	if(mysqli_num_rows($query_run)>0)
	{
		header('location:adm2.php');
	}
	else
	{
		echo '<script type="text/javascript"> alert("Sorry you are not one of the admins") </script>';
	}
}
?>
</div>
</body>
</html>