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
$enter=$object->fetchAllWhere("registration", "id", $_GET['id']);
while($row=mysql_fetch_array($enter)){

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
<center> <a href="../admin/menu.php" title="go home">Go to Admin Menu</a>|| Entry Date: <?php echo $row['entry_date'];?> </center>

<legend><h1><img src="images/zoom.gif" width="125" height="129" /><?php echo strtoupper($row['child_name']);?>'S Record  </h1></legend>
<center><h2><?php echo strtoupper($_GET['msg']); ?></h2></center>
<?php
	
	$id=$_GET['id'];
	$sql="SELECT * 
FROM `registration` 
WHERE id='$id' AND `treated`='0'";

	$result=mysql_query($sql);
	if(mysql_num_rows($result)>1){
		echo("<p class='er'>There are more than one clients who bear".$name."in the database</p>");
		}
	if(!$result){
		echo "<p class='er'>could not fetch Cleint records from the database:".mysql_error()."</p>";
		}
		if(mysql_num_rows($result)==0){
			die("<p class='er'>Mr/Mrs $name record is not in the Database. Client has not been registered</p>");
			}
			?>

<br/>
    
<table  width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" border="0">
  <tr>
      <td><strong>NAME:</strong></td>
      <td><strong><?php echo strtoupper($row['child_name']);?>&nbsp;</strong></td>
      <td>		    <?php
$object->displayPhoto($row['photo'], "../photo", "200");
?></td>
      </tr>
    <tr>
      <td height="68"><strong>SEX:</strong></td>
      <td>  <?php echo strtoupper($row['sex']);?>&nbsp;</td>

  <td>  <strong>STATE OF ORIGIN:</strong></td>
      <td><?php echo strtoupper($row['state_of_origin']);?>&nbsp;</td>
  </tr>
    <tr>
      <td height="47"><strong>DATE OF BIRTH:</strong></td>
      <td><?php echo $row['dob'];?>&nbsp;</td>
     
      <td><strong>PLACE OF BIRTH:</strong></td>
      <td><?php echo strtoupper($row['place_of_birth']);?>&nbsp;</td>
  </tr>
      <tr>
      <td height="44"><strong>AGE:</strong></td>
      <td><?php echo $row['age'];?>&nbsp;</td>
    
      <td><strong>LANGUAGES SPOKEN:</strong></td>
      <td><?php echo strtoupper($row['languages_spoken']);?>&nbsp;</td>
      </tr>
       <tr>
      <td height="42"><strong>LAST SCHOOL ATTENDED:</strong></td>
      <td><?php echo strtoupper($row['last_school_attended']);?>&nbsp;</td>
      <td><strong>LAST CLASS PASSED:</strong></td>
      <td><?php echo strtoupper($row['last_class_passed']);?>&nbsp;</td>
      </tr>
      <tr>
      <td height="50"><strong>REASON FOR LEAVING PREVIOUS SCHOOL:</strong></td>
      <td><?php echo strtoupper($row['reasons_for_leaving_last_school']);?>&nbsp;</td>
      <td><strong>CLASS YOU WISH YOUR CHILD TO BE ADMITTED:</strong></td>
      <td><?php echo strtoupper($row['class_you_wish_your_child_to_be_admitted_to']);?>&nbsp;</td>
      </tr>
      <tr><td colspan="4"><h2><center>Parent Details</center></h2></td></tr>
        <tr>
      <td height="59"><strong>DAD'S NAME:</strong></td>
      <td><?php echo strtoupper($row['dads_name']);?>&nbsp;</td>
      <td><strong>MUM'S NAME:</strong></td>
      <td><?php echo strtoupper($row['mums_name']);?>&nbsp;</td>
      </tr>
            <tr>
      <td height="64"><strong>DAD'S OFICE ADDRESS:</strong></td>
      <td><?php echo strtoupper($row['dads_office_address']);?>&nbsp;</td>
      <td><strong>MUM'S OFFICE ADDRESS:</strong></td>
      <td><?php echo strtoupper($row['mums_office_address']);?>&nbsp;</td>
      </tr>
           <tr>
      <td height="47"><strong>DAD'S RESIDENTIAL ADDRESS:</strong></td>
      <td><?php echo strtoupper($row['dads_residential_address']);?>&nbsp;</td>
      <td><strong>MUM'S RESIDENTIAL ADDRESS:</strong></td>
      <td><?php echo strtoupper($row['mums_residential_address']);?>&nbsp;</td>
  </tr>
             <tr>
      <td height="47"><strong>DAD'S PHONE NUMBER:</strong></td>
      <td><?php echo strtoupper($row['dads_phone']);?>&nbsp;</td>
      <td><strong>MUM'S PHONE NUMBER:</strong></td>
      <td><?php echo strtoupper($row['mums_phone']);?>&nbsp;</td>
      </tr>
              <tr>
      <td height="52"><strong>NATIONALITY:</strong></td>
      <td><?php echo strtoupper($row['nationality']);?>&nbsp;</td>
      <td><strong>SPECIAL HEALTH PROBLEM OF THE CHILD:</strong></td>
      <td><?php echo strtoupper($row['child_health_issues']);?>&nbsp;</td>
      </tr>
   
      <td height="64"><strong>NAME OF PARENT/GUARDIAN:</strong></td>
      <td><strong>SIGNATURE:</strong></td>
        <td><strong>DATE:</strong></td>
      </tr>
   <tr>
         <td>..............................................&nbsp;</td>

      <td>..............................................&nbsp;.......................</td>

      <td>..............................................&nbsp;</td>
</tr>

    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
     <?php if($row['treated']==0){?>
  <tr><td colspan="4"><center><h2>OFFICIAL USE ONLY</h2></center></td></tr>
    <tr>
  <td><strong>CHILD REGNO:</strong></td>
      <td><?php echo strtoupper($row['regno']);?>&nbsp;</td>

  <td><strong>DATE OF ADMISSION:</strong></td>
      <td><?php echo strtoupper($row['date_of_admission']);?>&nbsp;</td>
  </tr>
         <tr>
  <td><strong>CLASS ADMITTED TO:</strong></td>
      <td><?php echo strtoupper($object->getClass($row['class_admitted_into']));?>&nbsp;</td>

  <td><strong>ACKNOWLEDGED BY:</strong></td>
      <td><?php echo strtoupper($row['acknowledged_by']);?>&nbsp; </td>
      </tr>
      <tr>
      <td>HOUSE</td><td><?php echo strtoupper($row['house']);?></td>
           <td>DATE ACKNOWLEDGED:</td><td><?php echo strtoupper($row['date_of_acknowledgement']);?>&nbsp;</td>
 <?php } ?>
  
    <tr><td colspan="4"><center><SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<form>'
+ '<input type="button" name="print" value="  Print  " '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->
</SCRIPT></center></td></tr>
<Tr><td colspan="4">&nbsp;</td></Tr>
</table> 
          
          

</div>
</div>
<center><p>&copy;<?php echo date('Y'); ?>. All Rights Reserved</p></center>

</body>
</html>
<?php } ?>