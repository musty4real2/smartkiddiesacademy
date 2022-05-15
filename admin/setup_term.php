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
echo 'Do You Really Want To Turn On the visibility of these Subject if you do the subject would be available in the category ? <a href="setup_term.php?yesdelete='.$_GET['deleteid'].'">Yes </a>| <a href="setup_term.php">No</a>';
exit();

}

if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("UPDATE `term_setup` SET `status`='1' WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:setup_term.php");
	exit();
}
	if(isset($_GET['deleteid2'])){
echo 'Do You Really Want To Turn Off the visibility of these Subject if you do the subject would not be available in the category  ? <a href="setup_term.php?yesdelete2='.$_GET['deleteid2'].'">Yes </a>| <a href="setup_term.php">No</a>';
exit();

}

if(isset($_GET['yesdelete2'])){
	$id_to_delete=$_GET['yesdelete2'];
	$sql=mysql_query("UPDATE `term_setup` SET `status`='0' WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:setup_term.php");
	exit();
}

	if(isset($_GET['deleteid3'])){
echo 'Do You Really Want To Delete these Category if you do the category would not be available in the category? <a href="setup_term.php?yesdelete3='.$_GET['deleteid3'].'">Yes </a>| <a href="setup_term.php">No</a>';
exit();

}

if(isset($_GET['yesdelete3'])){
	$id_to_delete=$_GET['yesdelete3'];
	$sql=mysql_query("DELETE FROM `term_setup` WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:setup_term.php");
	exit();
}
		if(isset($_GET['deleteid4'])){
echo 'Do You Really Want To upload a logo for these Category if you do the category logo would be available ? <a href="setup_term.php?yesdelete4='.$_GET['deleteid4'].'">Yes </a>| <a href="setup_term.php">No</a>';
exit();

}if(isset($_GET['yesdelete4'])){
			$id=$_GET['yesdelete4'];

header("location:subject_logo_upload.php?id=$id");
exit();

}


?>
<?php

  $display = 40;
  // Determine how many pages there are...
  if (isset($_GET['p']) && is_numeric($_GET
  ['p'])) { // Already been determined.
  
  $pages = $_GET['p'];
  } else { // Need to determine.
  
  // Count the number of records:
  $q = "SELECT * FROM `term_setup`";
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
		$get="SELECT * FROM `term_setup` ORDER BY `id` DESC LIMIT $start, $display ";
		$get=$object->query($get);
		if(mysql_num_rows($get)==0){ echo "<p style='margin:30px 0 30px 0; text-align:center; border:1px solid #CCC;'>No Class Available</p>";}
		?>
<legend><b>VIEW ALL PAST AND CURRENT TERM</b><br/>
<center><p class="er">Please Note turn off visibility of all terms that have been concluded and leave the current terms visibility on</p></center><?php
if(mysql_num_rows($get)>0){
?>
</legend><table width="95%" border="0" cellspacing="1">
	<tr class="thead">
        <td height="45">S/N</td>
    <td>Sch. Opening Date</td>
      <td>Sch. Closing Date</td>
      <td>Sch. Resumption Date</td>
      <td>Max. Term Attendance</td>
      <td>Next Term Fee</td>
  <td>Visibility</td>
    <td></td>
    <td></td>
    </tr>
  <?php
$s=1;
  	while($l=mysql_fetch_array($get)){
		$id=$l['id'];

	echo "<tr class= \"trodd\">";
	?>
    <td height="47"><?php echo $s++;
	?></td>

    <td><?php echo $l['school_opening_date'];?></td>
        <td><?php echo $l['school_closing_date']; ?></td>
        <td><?php echo $l['resumption_date']; ?></td>
         <td><?php echo $l['max_attendance']; ?></td>
         <td><?php echo $l['term']."Term"; ?></td>
         <td><?php echo $l['status']; ?></td>
   <?php echo "<td><a href='setup_term.php?deleteid=$id'>Turn On Visibility</a></td>"; ?> 
   <?php echo "<td><a href='setup_term.php?deleteid2=$id'>Turn Off Visibility</a></td>"; ?> 
 
    <?php echo "<td><a href='setup_term.php?deleteid3=$id'>Delete</a></td>"; ?> 
        <?php echo "<td><a href='edit_subject.php?id=$id'>Edit</a></td>"; ?> 
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
 echo '<center><a href="setup_term.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }

for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="setup_term.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="setup_term.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</center>';// Close the paragraph.
 
}
 ?><br/>
        


</fieldset>
<fieldset style="margin-top:0px;">

<center><h4>Term Addition Form</h4></center>
<?php
$ass=$_GET['msg'];
echo $ass;
if($_POST['submit']){
	
	$maxattendance=addslashes($_POST['maxattendance']);
	if(strlen($maxattendance)==0){
		$error[]="maximum attendance for term is required<br/>";
		}
	


		$termfee=addslashes($_POST['termfee']);
	if(strlen($termfee)==0){
		$error[]="Next term free is required<br/>";
		}
		$term=addslashes($_POST['term']);
	if(strlen($term)==0){
		$error[]="Term is required<br/>";
		}
		
				$openingday=addslashes($_POST['openingday']);
	if(strlen($openingday)==0){
		$error[]="Opening Day is required<br/>";
		}
				$openingmonth=addslashes($_POST['openingmonth']);
	if(strlen($openingmonth)==0){
		$error[]="Opening Month is required<br/>";
		}
		
				$openingyear=addslashes($_POST['openingyear']);
	if(strlen($openingyear)==0){
		$error[]="Opening Year is required<br/>";
		}
		
						$closingday=addslashes($_POST['closingday']);
	if(strlen($closingday)==0){
		$error[]="Closing Day is required<br/>";
		}
				$closingmonth=addslashes($_POST['closingmonth']);
	if(strlen($closingmonth)==0){
		$error[]="Closing Month is required<br/>";
		}
		
				$closingyear=addslashes($_POST['closingyear']);
	if(strlen($closingyear)==0){
		$error[]="Closing Year is required<br/>";
		}
		
		
		
				
						$resumptionday=addslashes($_POST['resumptionday']);
	if(strlen($resumptionday)==0){
		$error[]="Resumption Day is required<br/>";
		}
				$resumptionmonth=addslashes($_POST['resumptionmonth']);
	if(strlen($resumptionmonth)==0){
		$error[]="Resumption Month is required<br/>";
		}
		
				$resumptionyear=addslashes($_POST['resumptionyear']);
	if(strlen($resumptionyear)==0){
		$error[]="Resumption Year is required<br/>";
		}
$resumption="$resumptionday/$resumptionmonth/$resumptionyear";
$opening="$openingday/$openingmonth/$openingyear";
$closing="$closingday/$closingmonth/$closingyear";
		
	
		if(!empty($error)){
			echo "<center><h3 class='error'>Error!</h3><p>The following error occured:</p></center>";
			foreach($error as $msg){
				echo "<center><p class='er'>$msg</p></center>";
				}
				}
		if($term){
			
			$sql="INSERT INTO `term_setup` (`resumption_date`, `school_closing_date`, `school_opening_date`, `max_attendance`, `term`, `next_term_fee`, `status`) VALUES ('$resumption', '$closing', '$opening', '$maxattendance', '$term', '$termfee', '0')";
	$result=mysql_query($sql);
	if(!$result){
		echo "could not complete entry:".mysql_error();
		}
		if($result){

	header("location:setup_term.php?msg=Successfully done");
		}
			}


}
?>

    <form id="tab" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

<fieldset>
    <table class="formtable" width="90%" border="0" height="411"> 
    </tr>
    <tr>
      <td height="72"  valign="middle" >school Opening Date</td>
      <td valign="middle">
        
        <?php 
		echo "<select name='openingday'>";
		echo "<option value=''>day</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da){
echo "<option value=$da>$da</option>";
	}
?>
</select>
    
		<?php echo "<select name='openingmonth'>";?>
        <?php $month=array('01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					echo "<option value=''>month</option>";
		echo "<option value=''>-----------------</option>";
	foreach($month as $months){
		echo "<option value=$months>$months</option>";
	}
?></select>    
    
    <?php  
			echo "<select name='openingyear'>";

	echo "<option value=''>year</option>";
		echo "<option value=''>---</option>";
		for($my=2004; $my<=2015; $my++){
		echo "<option value=$my>$my</option>";
			}
?></select>

        
      </td></tr><tr>
      <td height="36"  valign="middle"> School Closing Date</td>
      <td  valign="middle">
      <?php 
		echo "<select name='closingday'>";
		echo "<option value=''>day</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da){
echo "<option value=$da>$da</option>";
	}
?>
</select>
    
		<?php echo "<select name='closingmonth'>";?>
        <?php $month=array('01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					echo "<option value=''>month</option>";
		echo "<option value=''>-----------------</option>";
	foreach($month as $months){
		echo "<option value=$months>$months</option>";
	}
?></select>    
    
    <?php  
			echo "<select name='closingyear'>";

	echo "<option value=''>year</option>";
		echo "<option value=''>---</option>";
		for($my=2004; $my<=2015; $my++){
		echo "<option value=$my>$my</option>";
			}
?></select>

      
      </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
<!---end of mom details-->  
       <tr>
       <td height="30">Resumption Date</td>
       <td><?php 
		echo "<select name='resumptionday'>";
		echo "<option value=''>day</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da3){
echo "<option value=$da3>$da3</option>";
	}
?>
</select>
    
		<?php echo "<select name='resumptionmonth'>";?>
        <?php $month=array('01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					echo "<option value=''>month</option>";
		echo "<option value=''>-----------------</option>";
	foreach($month as $months3){
		echo "<option value=$months3>$months3</option>";
	}
?></select>    
    
    <?php  
			echo "<select name='resumptionyear'>";

	echo "<option value=''>year</option>";
		echo "<option value=''>---</option>";
		for($my3=2004; $my3<=2015; $my3++){
		echo "<option value=$my3>$my3</option>";
			}
?></select>
</td></tr>
<tr>
<td height="46">Total Fee for Next Term</td><td>
<input type="text" name="termfee" value=""/></td></tr>
<tr><td height="51">This term Max Attendance</td><td><input type="text" name="maxattendance" size="3" /></td></tr>
<tr><td height="70">This is which term</td>
<td>    <?php  
			echo "<select name='term'>";

	echo "<option value=''>Select Current Term</option>";
		echo "<option value=''>---</option>";
		for($my=1; $my<=3; $my++){
		echo "<option value=$my>$my Term</option>";
			}
?></select></td></tr>
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