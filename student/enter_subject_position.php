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
		$get="SELECT * FROM `term_setup` WHERE `status`='1' ORDER BY `id` DESC LIMIT 1 ";
		$get=$object->query($get);
		if(mysql_num_rows($get)==0){ 
		}

if(mysql_num_rows($get)>0){
	
  	while($l=mysql_fetch_array($get)){
		$num1=$l['id'];
		$term=$l['term']; 
}
}
?>		 

</table>
      </td>
            
          
      </tr>
        </table><br/>
       


</fieldset>
<fieldset style="margin-top:0px;">
<center>        <a href="menu.php" title="go home">Admin Menu</a>|| <?php echo "<a href='enterca.php?id={$_GET['id']}&regno={$_GET['regno']}&classid={$_GET['classid']}'>Go Back To Student Page.</a>" ?></label></td>
</center>


<center>
  <h4>Enter Subject Position Form</h4></center>
<?php
	$ass=$_GET['msg'];

echo $ass;
if($_POST['submit']){
$regno=$_GET['regno'];
$subid=$_GET['subid'];
$studentid=$_GET['id'];
$classid=$_GET['classid'];
	$term_m=addslashes($_POST['term']);
	
	$termidd=addslashes($_POST['termiid']);
	
	$score=addslashes($_POST['score']);
	if(strlen($score)==0){
		$error[]="Please Score for welcome test is required<br/>";
		}	
	
		if(!empty($error)){
			echo "<center><h3 class='error'>Error!</h3><p>The following error occured:</p></center>";
			foreach($error as $msg){
				echo "<center><p class='er'>$msg</p></center>";
				}
				}
		if($score){
			
			$sql="UPDATE `ca` SET `exam` = '$score' WHERE `status`='1' AND `student_regno`='{$_GET['regno']}' AND `student_id`='{$_GET['id']}'  AND `subject_id`='{$_GET['subid']}' LIMIT 1";
			
			
	$result=mysql_query($sql);
	if(!$result){
		echo "could not complete entry:".mysql_error();
		}
		if($result){

	header("location:enterca.php?id=$studentid&regno=$regno&classid=$classid&msg=Successfully done");
		}
			}


}
?>
 <?php
		$get1="SELECT * FROM `ca` WHERE `status`='1' AND `student_regno`='{$_GET['regno']}' AND `student_id`='{$_GET['id']}'  AND `subject_id`='{$_GET['subid']}' ORDER BY `id` DESC LIMIT 1 ";
		$get11=$object->query($get1);
		if(mysql_num_rows($get11)==0){ 
		}

if(mysql_num_rows($get11)>0){
	
  	while($l=mysql_fetch_array($get11)){
		$welcome_test=$l['welcome_test'];
		$ca1=$l['ca1_test']; 
		$midterm_test=$l['midterm_test']; 
		$ca2_test=$l['ca2_test'];
		$ca2_test=$l['ca2_test'];
		$exam=$l['exam'];
}
}
$ct1=$object->countSubject($_GET['classid']);

$total=$welcome_test+$ca1+$midterm_test+$ca2_test+$exam;
	$check = mysql_query("SELECT * FROM `subject_position` WHERE `status`='1' AND `student_regno`='{$_GET['regno']}' AND `user_id`='{$_GET['id']}'  AND `subject_id`='{$_GET['subid']}'");
if(mysql_num_rows($check)>0){
}elseif 
(mysql_num_rows($check)==0) {
	$sql11="INSERT INTO `subject_position` (`term`, `user_id`, `position`, `total`, `subject_id`, `status`, `student_regno`,`class`) VALUES ('$term', '{$_GET['id']}', '', '$total', '{$_GET['subid']}', '1', '{$_GET['regno']}','{$_GET['classid']}')";
}
	
		$result=mysql_query($sql11);
		if($result){
				$get001="SELECT * FROM `subject_position` WHERE `status`='1' AND `student_regno`='{$_GET['regno']}' AND `user_id`='{$_GET['id']}'  AND `subject_id`='{$_GET['subid']}'  AND `position`='' ORDER BY `total` DESC";
		$get101=$object->query($get001);
		if(mysql_num_rows($get101)==0){ 
		}

if(mysql_num_rows($get101)>0){
	?>
    <table class="restable" border="0" b style="text-align:center;" > 
  <tr style="background-color:#0e9dcc; color:#FFF; font-family:Tahoma, Geneva, sans-serif;">
    <th>Regno</td>
    <th>Score</td>
    <th><center>Class</center></th>
     <th></th>
      <th></th>

  </tr>
    
    
    <?php
  	while($l=mysql_fetch_array($get101)){
		$ttt=$l['total'];
		$regnno=$l['student_regno']; 
		 echo '<tr bgcolor="' . $bg . '">';  ?>
        <td><?php echo $regnno;?></td>
<td><?php echo $ttt;?></td>
    <td><?php echo $object->getStudent($l['student_id']);?></td>
        
    <td><?php echo $object->getClass($l['class']); ?></td>
        <?php echo "<center><td><a href='.php?subid=$subid&regno=$regno&classid=$classid&id=$id'>Enter Subject Position</a></td></center>"; ?> 

<?php
		
}
}	
			
			
			
			
			
			
		}
		
?>
</div></div>

<center><p>&copy;<?php echo date('Y'); ?>. All Rights Reserved.</p></center>



</body>

</html>