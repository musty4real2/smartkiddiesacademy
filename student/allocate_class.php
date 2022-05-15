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
<title></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="wrapper">
<div id="head">
<?php $object->head("logo"); ?>
</div>


<div id="body">
<fieldset style="margin-top:0px;">

<center><h1 class="h4">Class Allocation Form</h4></center>
<?php
if($_POST['submit']){
	
	$acknowledgedby=addslashes($_POST['acknowledgedby']);
	if(strlen($acknowledgedby)==0){
		$error[]="the name of the acknowledger is required<br/>";
		}
	
$reg=addslashes($_POST['reg']);

		$wname=addslashes($_POST['wname']);
		$addate=addslashes($_POST['addate']);
		$acdate=addslashes($_POST['acdate']);
		$house=addslashes($_POST['house']);
	
		

		
	
		if(!empty($error)){
			echo "<center><h3 class='error'>Error!</h3><p>The following error occured:</p></center>";
			foreach($error as $msg){
				echo "<center><p class='er'>$msg</p></center>";
				}
				}
		if($acknowledgedby){
			
			$sql="UPDATE `registration` SET `regno` = '$reg',`date_of_admission` = '$addate',`class_admitted_into` = '$wname',`acknowledged_by` = '$acknowledgedby',`date_of_acknowledgement` = '$acdate',`treated` = '0',`house` = '$house' WHERE `id` ='{$_GET['id']}' LIMIT 1";
	$result=mysql_query($sql);
	if(!$result){
		echo "could not complete entry:".mysql_error();
		}
		if($result){
$sql1="INSERT INTO `admitted` (`regno`, `class_id`, `status`, `promote`, `demote`, `entry_date`, `student_id`) VALUES ( '$reg', '$wname', 'promoted', '1', '0', NOW(), '{$_GET['id']}')";
$result1=mysql_query($sql1);
	header("location:view_record2.php?id={$_GET['id']}&msg=Admission Process Has Been Completed");
		}
			}


}
?>

    <form id="tab" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

<fieldset>
    <table class="formtable" width="90%" border="0" height="80"> 
    <tr>
      <td  valign="middle"> Child Registration Number:</td>
      <td  valign="middle"><label>
        <?php
		 $dda=$object->count3()+1;
		 
 $n = "SKA/".date('y')."/".$dda;
 echo $n;
 ?>        <input type="hidden" name="reg" id="name"  value="<?php echo $n; ?>" size="60"/><span class="warning">***</span>

      </label></td>
    </tr>
       <tr>
      <td  valign="middle"> Date of Admission:</td>
      <td  valign="middle"><label>
<?Php  $admdate=$object->currentDate(); 
echo $admdate;
?>
<input type="hidden" name="addate" id="name"  value="<?php echo $admdate; ?>" size="60"/><span class="warning">***</span>

      </label></td>
    </tr>
    
    <tr>
      <td  valign="middle" >Class Admitted to:</td>
      <td valign="middle"><label>
        <?php
  $auto=mysql_query("SELECT *  FROM `class` ORDER BY `class_name` ASC"); ?>
<select class="input" name='wname'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($auto)){
$id=$row['id'];
$catname=$row['class_name'];

echo "<option value='$id'>$catname</option>";
}
 ?>
 </select><span class="warning">***</span>
      </label></td></tr>
        <tr>
      <td  valign="middle" >Acknowledged By:</td>
      <td valign="middle"><label>
        <input type="text" name="acknowledgedby" id="name"  value="" size="60"/><span class="warning">***</span>
      </label></td></tr>
<!---end of mom details-->  
            <tr>
      <td  valign="middle"> Date of Acknowledgement:</td>
      <td  valign="middle"><label>
<?Php $acknowledgeddate=$object->currentDate();
  echo $acknowledgeddate; ?>
  <input type="hidden" name="acdate" id="name"  value="<?php echo $acknowledgeddate; ?>" size="60"/><span class="warning">***</span>

      </label></td>
    </tr>
       <tr>
      <td  valign="middle" >House:</td>
      <td valign="middle"><label>
        <input type="text" name="house" id="name"  value="" size="60"/><span class="warning">***</span>
      </label></td></tr>
    <tr>
    <td>&nbsp;</td>
      <td><input type="submit" name="submit"  value="Submit"  class="but" style="margin-top:30px;"/></td>
      
       <td>&nbsp;</td>
    </tr>
    

    
  </table>
</fieldset>
</form>
<center>        <a href="menu.php" title="go home">Admin Menu</a></label></td>
</center>
</div></div>

<center><p>&copy;<?php echo date('Y'); ?>. All Rights Reserved.</p></center>



</body>

</html>