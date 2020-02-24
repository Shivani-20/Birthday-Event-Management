<?php
require 'config.php';
session_start();
?>	

<?php
$cust=$_SESSION['xx'];
$ll=$_SESSION['yy'];
$query="select total_amount from payment where b_id='$ll'";
$query_run=mysqli_query($con,$query);
$info=mysqli_fetch_assoc($query_run);
$_SESSION['rr']="$info[total_amount]";
$rr=$_SESSION['rr'];
if($rr<50000)
{
	$con=new PDO("mysql:host=localhost;dbname=birthday",'root','');

$sql="CALL discount1()";
$res=$con->prepare($sql);
$res->setFetchMode(PDO::FETCH_ASSOC);
$res->execute();
}
if($rr>=50000 && $rr<=100000)
{
	$con=new PDO("mysql:host=localhost;dbname=birthday",'root','');

$sql="CALL discount2()";
$res=$con->prepare($sql);
$res->setFetchMode(PDO::FETCH_ASSOC);
$res->execute();
}
if($rr>100000)
{
	$con=new PDO("mysql:host=localhost;dbname=birthday",'root','');

$sql="CALL discount3()";
$res=$con->prepare($sql);
$res->setFetchMode(PDO::FETCH_ASSOC);
$res->execute();
}
?>