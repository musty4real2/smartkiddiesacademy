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
<fieldset style="margin-top:0px;">  
  <?php

  $sql="SELECT * FROM `admitted` WHERE `class_id`='{$_GET['classid']}' AND `regno`='{$_GET['regno']}'  AND `id`='{$_GET['id']}' LIMIT 1";



	$result=mysql_query($sql);
	if(!$result){
		echo "could not fetch Cleint records from the database:".mysql_error();
		}
	echo mysql_num_rows($result)." registered clients";
	if(mysql_num_rows($result)!=0){
		?>
        <center>        <a href="menu.php" title="go home">Admin Menu</a>|| <?php echo "<a href='addca.php?class={$_GET['classid']}'>Back</a>" ?></label></td>

<table class="restable" border="0" b style="text-align:center;" > 
  <tr style="background-color:#0e9dcc; color:#FFF; font-family:Tahoma, Geneva, sans-serif;">
    <th>Regno</td>
    <th>Child Name</td>
    <th>Entry_date</th>
    <th>Class</th>
  </tr>
<?php 
$bg = '#eeeeee';
	while ($row=mysql_fetch_array($result)){
 $id=$row['id'];	
 $classid=$row['class_id'];		
  $regno=$row['regno'];
$bg = ($bg=='#eeeeee' ? '#ffffff' :
'#eeeeee'); // Switch the background


 echo '<tr bgcolor="' . $bg . '">';  ?>
    <td><?php echo $regno;?></td>
    <td><?php echo $object->getStudent($row['student_id']);?></td>
    <td><?php echo $row['entry_date'];?></td>    
    <td><?php echo $object->getClass($classid); ?></td>

  </tr>
  
<?php }
echo "</table><center><div>";
  }
?>
</table>
 <?php
		$get="SELECT * FROM `subjects` WHERE `subject_class_id`='{$_GET['classid']}' ORDER BY `id`";
		$get=$object->query($get);
		if(mysql_num_rows($get)==0){ echo "<p style='margin:30px 0 30px 0; text-align:center; border:1px solid #CCC;'>No Subject Available</p>";}
		?>
<legend><b>All Subjects Offered</b><?php
if(mysql_num_rows($get)>0){
?>
</legend><table width="95%" border="0" cellspacing="1">
	<tr class="thead">
        <td>S/N</td>
    <td>Subject Name</td>
      <td>Welcome Test (5)</td>
  
    <td>CA Test 1 (10)</td>
    <td>Mid-term Test (20)</td>
    <td>CA Test 2 (5)</td>
    <td>Exam (60)</td>
     <td>position</td>
    </tr>
  <?php
$s=1;
  	while($l=mysql_fetch_array($get)){
		$subid=$l['id'];

		$catid=$l['subject_class_id'];
	echo "<tr class= \"trodd\">";
	?>
    <td height="32"><?php echo $s++;
	?></td>

    <td><?php echo $l['subject_name'];?></td>
    <?php  
    echo "<center><td><a href='enter_welcome_test.php?subid=$subid&regno=$regno&classid=$classid&id=$id'>Enter Welcome Test</a></td></center>"; 
	 ?>
   <?php echo "<center><td><a href='enter_ca1.php?subid=$subid&regno=$regno&classid=$classid&id=$id'>Enter CA Test</a></td></center>"; ?> 
   <?php echo "<center><td><a href='midterm_test.php?subid=$subid&regno=$regno&classid=$classid&id=$id'>Enter Mid-term Test</a></td></center>"; ?> 
   <?php echo "<center><td><a href='enter_ca2.php?subid=$subid&regno=$regno&classid=$classid&id=$id'>Enter CA 2 Test</a></td></center>"; ?> 
    <?php echo "<center><td><a href='enter_exam.php?subid=$subid&regno=$regno&classid=$classid&id=$id'>Enter Exam</a></td></center>"; ?> 

    <?php echo "<center><td><a href='enter_subject_position.php?subid=$subid&regno=$regno&classid=$classid&id=$id'>Enter Subject Position</a></td></center>"; ?> 
 </tr>
 <?php 
}
}
?>		 

</table><br/>

 <?php
	$gett="SELECT * FROM `subjects` WHERE `subject_class_id`='{$_GET['classid']}' ORDER BY `id`";
		$gett=$object->query($gett);
		if(mysql_num_rows($gett)==0){ echo "<p style='margin:30px 0 30px 0; text-align:center; border:1px solid #CCC;'>No Subject Available</p>";}
		?>
<legend><b>Score Summary of Subjects Offered</b><?php
if(mysql_num_rows($gett)>0){
?>
</legend><table width="95%" border="0" cellspacing="1">
	<tr class="thead">
        <td>S/N</td>
    <td>Subject Name</td>
      <td>Total</td>
      <td>Average</td>
      <td>Grade</td>
       <td>Remark</td>

    </tr>
  <?php
$s=1;
  	while($l=mysql_fetch_array($gett)){
		$subid=$l['id'];

		$catid=$l['subject_class_id'];
	echo "<tr class= \"trodd\">";
	?>
    <td height="32"><?php echo $s++;
	?></td>

    <td><?php echo $l['subject_name'];?></td> 
    <td><?php echo $object->getTotal($subid,$id); ?>

    <td><?php echo  $object->getAvg($subid,$id); ?>
    <td><?php echo  $object->getGrade($subid,$id); ?>
    <td><?php echo  $object->getRemark($subid,$id); ?>
</td>
 </tr>
 <?php 
}
}
?>		 

</table>

		 

<center>   <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<form>'
+ '<input type="button" name="print" value="  Print Student  " '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->
</SCRIPT></center>
</fieldset>
</div>
</div>
<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>

</body>
</html>