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


<center><h4>Enter Welcome Test Result Form</h4></center>
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
			$sql="INSERT INTO `ca` (`subject_id`, `student_id`, `student_regno`, `term`, `welcome_test`, `ca1_test`, `midterm_test`, `ca2_test`, `exam`, `total`, `status`, `term_id`,`class_id`,`average`,`grade`) VALUES ('$subid', '$studentid', '$regno', '$term_m', '$score', '', '', '', '', '', '1', '$num1','$classid','','')";
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
$average=number_format($total/$ct1,3);
if($total<=49){
	$grade="F";
		$remark="Fail";

}
elseif($total<=59){
	$grade="E";
		$remark="Pass";

}
elseif($total<=69){
	$grade="D";
		$remark="Average";

}
elseif($total<=79){
	$grade="C";
		$remark="Good";

}
elseif($total<=89){
	$grade="B";
		$remark="V. Good";

}
elseif($total>=90){
	$grade="A";
	$remark="Excellent";
}

$sql11="UPDATE `ca` SET `total` = '$total',`average` = '$average',`grade` = '$grade',`remark` = '$remark' WHERE `status`='1' AND `student_regno`='{$_GET['regno']}' AND `student_id`='{$_GET['id']}'  AND `subject_id`='{$_GET['subid']}' LIMIT 1";
			
			
	$result=mysql_query($sql11);
?>
<?php if($welcome_test==""){?>
    <form id="tab" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

<fieldset>
    <table class="formtable" width="90%" border="0"> 
<tr><td height="51">Enter welcome Test Score</td><td><input type="text" name="score" size="3" /></td></tr>

<input type="hidden" name="term" value="<?php echo "$term"; ?>"/>

<input type="hidden" name="termiid" value="<?php echo "$num1"; ?>"/>
    <tr>
    <td>&nbsp;</td>
      <td><input type="submit" name="submit"  value="Enter"  class="but" style="margin-top:30px;"/></td>
      
       <td>&nbsp;</td>
    </tr>
  </table>
</fieldset>
</form>
<?php }else{ echo "<h1><center><p class=\"er\">The Score of This Student's Welcome Test on The Selected Subject Has Been Entered !!! Consult Administrators For Help<br/>

He/She Scored $welcome_test / 5</p></center></h1>"; } ?>
</div></div>

<center><p>&copy;<?php echo date('Y'); ?>. All Rights Reserved.</p></center>



</body>

</html>