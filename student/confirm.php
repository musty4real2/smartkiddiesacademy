<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

//redirect to setup if system not setup!!!!
$getit=$object->query("SELECT * FROM `companysetup`");
if(mysql_num_rows($getit)==0){
	//redirect
	header("location:../setup/executive+login.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> </title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
<div id="head">
<?php $object->head("logo"); ?>
</div>


<div id="body">
<fieldset style="margin-top:50px;">



<div class="enter">
<center><h1 class="h1"><img src="../images/ok.gif" width="68" height="62" />Entry Succesful</h1></center>

<center>
  <h3 class="h1" style="color:#999;"><?php $name=$_GET['name'];echo $name;?>'s Record Has Been Successfully Submitted To The Administrative Office You Would Be Informed As Soon As A Class Has Allocated To The Child.</h3>
<br/><a href="../admin/menu.php"><img src="../images/home.gif" /></a></center>

</div>


</div>
<center><p>&copy;<?php echo date('Y'); ?>. All Rights Reserved. </p></center>

</body>
</html>