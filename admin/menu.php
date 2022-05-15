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
//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
<div id="head">
<?php $object->head("logo"); ?>
</div>
<div id="body">
<fieldset style="margin-top:50px;">
<table  style="text-align:center; margin-top:50px;" border="0" width="100%" height="300">
<tr>
<td><a title="Register Client" href="../student/registration.php"><img   src="../images/add_voters.gif" width="73" height="75" /><br/>Register a Student</a></td>
<td><a  title="registered client" href="../student/registered_clients.php"><img src="../images/result2.gif" width="88" height="62" /><br/>View Unallocated Students</a></td>
<td><a href="../student/registered_clients2.php" title="search for a client"><img src="../images/search voter.gif" width="66" height="64" /><br/>
  View Allocated Students</a></td>
<td><a href="manage_subject.php" title="add or remove from inventory"><img src="../images/up.png" width="67" height="60" /><br/>
  Add Subject to a Class</a></td>
<td><a href="add_class.php" title="add new product to the inventry"><img src="../images/magic.gif" width="66" height="62" /><br/>Manage Class</a></td>
</tr>
<tr>
<td><a href="../student/select.php" title="search for a client"><img src="../images/zoom.gif" width="71" height="73" /><br/>
View All Admitted In A Class</a></td>
<td><a href="setup_term.php" title="Lodge a client"><img src="../images/icon_bagages.jpg" width="74" height="74" /><br/>Setup Term Details</a></td>
<td><a href="../student/selectca.php" title="Print meal menu for client"><img src="../images/list.gif" width="70" height="75" /><br/>Enter Assessment</a></td>
<td><a href="remove_stock_form.php" title="Form for removing from stock"><img src="../images/addto.gif" alt="" width="66" height="52" /> <br/>Remove from stock Form</a></td>

<td><a href="client/lodged_client.php" title="Lodged client"><img src="../images/user-group-icon.png" width="74" height="74" /> <br/>
  Lodged client</a></td>

</tr>
</table>
</fieldset>
</div>
</div>
<center><p>&copy;<?php echo date("Y");?>. All Rights Reserved. </p></center>


</body>
</html>