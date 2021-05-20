<!Doctype html>
<html>
<body>
<form action="mm.php" method="POST">
Phone<input type="text" name="pp"/>
<input type="submit" name="ss" value="Submit"/>
</form>
<?php
if(isset($_POST['ss']))
{
$phone=$_POST['pp'];
if(preg_match("/^[+]?(\d{2})?[\s-]?\(?\d{10}\)?$/",$phone)) 
{
echo "Valid<br>";
}
else
{
echo "Invalid<br>";
}
}
?>
</body>
</html>