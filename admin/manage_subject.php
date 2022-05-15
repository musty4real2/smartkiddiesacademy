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
 <?php

if(isset($_GET['deleteid'])){
echo 'Do You Really Want To Turn On the visibility of these Subject if you do the subject would be available in the category ? <a href="manage_subject.php?yesdelete='.$_GET['deleteid'].'">Yes </a>| <a href="manage_subject.php">No</a>';
exit();

}

if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("UPDATE `subjects` SET `visibility`='1' WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:manage_subject.php");
	exit();
}
	if(isset($_GET['deleteid2'])){
echo 'Do You Really Want To Turn Off the visibility of these Subject if you do the subject would not be available in the category  ? <a href="manage_subject.php?yesdelete2='.$_GET['deleteid2'].'">Yes </a>| <a href="manage_subject.php">No</a>';
exit();

}

if(isset($_GET['yesdelete2'])){
	$id_to_delete=$_GET['yesdelete2'];
	$sql=mysql_query("UPDATE `subjects` SET `visibility`='0' WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:manage_subject.php");
	exit();
}

	if(isset($_GET['deleteid3'])){
echo 'Do You Really Want To Delete these Category if you do the category would not be available in the category? <a href="manage_subject.php?yesdelete3='.$_GET['deleteid3'].'">Yes </a>| <a href="manage_subject.php">No</a>';
exit();

}

if(isset($_GET['yesdelete3'])){
	$id_to_delete=$_GET['yesdelete3'];
	$sql=mysql_query("DELETE FROM `subjects` WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:manage_subject.php");
	exit();
}
		if(isset($_GET['deleteid4'])){
echo 'Do You Really Want To upload a logo for these Category if you do the category logo would be available ? <a href="manage_subject.php?yesdelete4='.$_GET['deleteid4'].'">Yes </a>| <a href="manage_subject.php">No</a>';
exit();

}if(isset($_GET['yesdelete4'])){
			$id=$_GET['yesdelete4'];

header("location:subject_logo_upload.php?id=$id");
exit();

}


?>
<?php

  $display = 10;
  // Determine how many pages there are...
  if (isset($_GET['p']) && is_numeric($_GET
  ['p'])) { // Already been determined.
  
  $pages = $_GET['p'];
  } else { // Need to determine.
  
  // Count the number of records:
  $q = "SELECT * FROM `subjects`";
  $r = mysql_query ($q);
  $records=mysql_num_rows($r);
  if(!$r){echo  "SYSTEM ERROR: Server cannot execute query.".mysql_error();}
  if(empty($r)){echo "SYSTEM ERROR: Server cannot execute query.".mysql_error();}
  
  
  // Calculate the number of pages...
  if ($records > $display) { // More than
  $pages = ceil ($records/$display);
  } else {
  $pages = 1;
  }
  }
  if (isset($_GET['s']) && is_numeric
  ($_GET['s'])) {
  $start = $_GET['s'];
  } else {
  $start = 0;
  }
?>
        <?php
		$get="SELECT * FROM `subjects` ORDER BY `id` DESC LIMIT $start, $display ";
		$get=$object->query($get);
		if(mysql_num_rows($get)==0){ echo "<p style='margin:30px 0 30px 0; text-align:center; border:1px solid #CCC;'>No Subject Available</p>";}
		?>
<legend><b>View All Subjects</b><?php
if(mysql_num_rows($get)>0){
?>
</legend><table width="95%" border="1" cellspacing="1">
	<tr class="thead">
        <td>S/N</td>
    <td>Subject Name</td>
      <td>Class for</td>
  <td>Visibility</td>
    <td></td>
    <td></td>
    </tr>
  <?php
$s=1;
  	while($l=mysql_fetch_array($get)){
		$id=$l['id'];

		$catid=$l['subject_class_id'];
	echo "<tr class= \"trodd\">";
	?>
    <td height="32"><?php echo $s++;
	?></td>

    <td><?php echo $l['subject_name'];?></td>
        <td><?php echo $object->getClass($catid); ?></td>

   <td><?php echo $l['visibility'] ;?></td>
   <?php echo "<td><a href='manage_subject.php?deleteid=$id'>Turn On Visibility</a></td>"; ?> 
   <?php echo "<td><a href='manage_subject.php?deleteid2=$id'>Turn Off Visibility</a></td>"; ?> 
 
    <?php echo "<td><a href='manage_subject.php?deleteid3=$id'>Delete</a></td>"; ?> 
 </tr>
 <?php 
}
}
?>		 

</table>
      </td>
            
          
      </tr>
        </table><br/>
        <?php 
  //paginate result set
if ($pages > 1) {
echo '<center>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="manage_subject.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }

for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="manage_subject.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="manage_subject.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</center>';// Close the paragraph.
 
}
 ?><br/>
        


</fieldset>
<fieldset style="margin-top:0px;">

<center><h1 class="h4">Subject Addition Form</h4></center>
<?php
if($_POST['submit']){
	
	$subjectname=addslashes($_POST['subjectname']);
	$wname=addslashes($_POST['wname']);
	if(strlen($subjectname)==0){
		$error[]="subject Name is required<br/>";
		}
	
		if(!empty($error)){
			echo "<center><h3 class='error'>Error!</h3><p>The following error occured:</p></center>";
			foreach($error as $msg){
				echo "<center><p class='er'>$msg</p></center>";
				}
				}
		if($subjectname){
			
			$sql="INSERT INTO `smart`.`subjects` (`subject_name`,`subject_class_id`,`visibility`,`entry_date`)
VALUES ('$subjectname', '$wname', '0', NOW())";
	$result=mysql_query($sql);
	if(!$result){
		echo "could not complete entry:".mysql_error();
		}
		if($result){

	header("location:manage_subject.php");
		}
			}


}
?>

    <form id="tab" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

<fieldset>
    <table class="formtable" width="90%" border="0" height="80"> 
    </tr>
    <tr>
      <td  valign="middle" >Subject Name:</td>
      <td valign="middle"><label>
        <input type="text" name="subjectname" id="name"  value="" size="60"/><span class="warning">***</span>
      </label></td></tr><tr>
      <td  valign="middle"> Class Subject Is For:</td>
      <td  valign="middle"><label>
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
 </select>
      </label></td>
    </tr>
<!---end of mom details-->  
       
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