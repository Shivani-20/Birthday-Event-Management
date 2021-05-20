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

<link rel="stylesheet" href="style.css">
</head>

<body style="background:url(bb.jpg);">
<div class="top-container">
  <h1 style="font-family:Helvetica">WELCOME TO BIRTHDAY MANAGEMENT SYSTEM</h1>
  </div>
<marquee style="font-family:Forte;font-size:16pt;color:white;"> *******please REGISTER before LOGIN*******</marquee>
<div id="ma">
<center><h2><u>login-form</u></h2></center>


<form action="index.php" method="post" class="f">

<label><b>Login_id</b></label>
<br>
<input name="uid" type="text" class="inputvalues" placeholder="type ur login_id" />
<br>

<label><b>Password</b></label>
<br>
<input name="pd" type="password" class="inputvalues" placeholder="type ur password"/><br>
<br>


<input name="lid" type="submit" id="l" value="login"/>


</form>

<?php

if(isset($_POST['lid']))
{
	$x=$_POST['uid'];
	$y=$_POST['pd'];
	$query="select user_id from users where login_id='$x' AND password='$y'";
	$query_run=mysqli_query($con,$query);
	
	if(mysqli_num_rows($query_run)>0)
	{
		$info=mysqli_fetch_assoc($query_run);
	    $_SESSION['xx']="$info[user_id]";
	    
		header('location:home.php');
	
	}
	else
	{
		echo '<script type="text/javascript"> alert("user not found") </script>';
	}
}
?>
</div>
<div id="am">
<center><h2><u>register-form</u></h2></center>


<form action="index.php" method="post" class="f">

<label><b>NAME</b></label>
<br>
<input name="nn" type="text" class="inputvalues" required/>
<br>

<label><b>LOGIN_ID</b></label>
<br>
<input name="nw" type="text" class="inputvalues" required/>
<br>


<label><b>PHONE</b></label>
<br>
<input name="pp" type="number" class="inputvalues" required/>
<br>

<label><b>PASSWORD</b></label>
<br>
<input name="pa" type="password" class="inputvalues" required/>
<br>

<label><b>CONFIRM PASSWORD</b></label>
<br>
<input type="password" name="cp" class="inputvalues" required/>
<br>
<br>
<label><b>GENDER</b></label>
<br>
<input type="radio" name="gg" value="male" required/> Male<br>
<input type="radio" name="gg" value="female"> Female<br>
<br>
<br>

<input type="submit" name="rr" id="r" value="register"/>
<br>
<br>

</form>
<?php
if(isset($_POST['rr']))
{
$pass=$_POST['pa'];

	if($pass==$_POST['cp'])
	{
		$tt=$_POST['nw'];	
		$query="select * from users WHERE LOGIN_ID='$tt'";
		
		$query_run=mysqli_query($con,$query);
		if(mysqli_num_rows($query_run)>0)
		{
			echo '<script type="text/javascript"> alert("user already exists") </script>';
		}
		else
		{
			$un=$_POST['nn'];
            $p=$_POST['pp'];
            $cn=$_POST['cp'];
            $ge=$_POST['gg'];
			
		    $q="insert into users values('$un','$p','$cn','$ge','','$tt')";
		    $q1=mysqli_query($con,$q);
			if($q1)
			{
			echo '<script type="text/javascript"> alert("Successful! Login to start booking") </script>';	
		    }
		    else
		    {
			echo '<script type="text/javascript"> alert("Server down") </script>';
		    }
		
	    }
    }
	else
	{
		  echo '<script type="text/javascript"> alert("password did not match") </script>';
	}
}

?>
</div>
<br>
<br>
<br>
<br>
<br>

  <input class="b1" type="button" onclick="location.href='abt_us.php';" value="About us" style="font-size:12pt;"/>
  <input class="b2" type="button" onclick="location.href='priv.php';" value="Privacy" style="font-size:12pt;"/>
  <input class="b3" type="button" onclick="location.href='faq.php';" value="FAQs" style="font-size:12pt;"/>
  <input class="b4" type="button" onclick="location.href='adm.php';" value="ADMIN" style="font-size:12pt;"/>
 
</body>
</html>