
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gilgal Health Resource Centre</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="wrapper">
<div id="head">
<img src="../images/HEAD.jpg" width="1200" height="115" />
</div>


<div id="body">
<fieldset style="margin-top:50px;">

<h1 class="h1"><img src="../images/add_voters.gif" width="94" height="99" />Client Registration Form</h1>
<?php
if($_POST['submit']){
	
	$name=addslashes($_POST['name']);
	if(strlen($name)==0){
		$error[]="Client's Name is required<br/>";
		}
	
	
	

	$add=addslashes($_POST['add']);
	if(strlen($add)==0){
		$error[]="Client's Address is required<br/>";
		}
	
	$pnum=$_POST['pnum'];
	

	
	
	
	$age=$_POST['age'];
	
	
	
	$religion=$_POST['religion'];
	if(strlen($religion)==0){
		$error[]="Client's Religion is required<br/>";
		}
	
	
	$condition=addslashes($_POST['condition']);

	
	$previous=addslashes($_POST['previous']);
	
	$how=addslashes($_POST['how']);

	$email=addslashes($_POST['email']);	
	$why=addslashes($_POST['why']);	
	
	$month=$_POST['month'];
	$day=$_POST['day'];
	$year=$_POST['year'];
	
	$date="$day-$month-$year"; 
	
	
	$sub=substr($year, 2);
	$reg="$day$month$sub";
	
	
	$remark=addslashes($_POST['remark']);
	
	$present=addslashes($_POST['present']);

		if(!empty($error)){
			echo "<center><h3 class='error'>Error!</h3><p>The following error occured:</p></center>";
			foreach($error as $msg){
				echo "<center><p class='er'>$msg</p></center>";
				}
				}
		if($name && $add && $religion){
			
			include ("../db_connect.php");
			$sql="INSERT INTO `gilgal`.`registration` (
`name` ,
`address` ,
`pnum` , `email`, 
`age` ,
`religion` ,
`condition` ,
`previous` ,
`how` ,
`why`,`date`,
`reg_no`, 
`remark` , `present`
)
VALUES (
 '$name', 
 '$add',
 '$pnum', '$email', 
 '$age', 
 '$religion', 
 '$condition',
 '$previous', 
 '$how',
 '$why',
 '$date',
 '$reg', 
 '$remark', '$present')";
	$result=mysql_query($sql);
	if(!$result){
		echo "could not complete entry:".mysql_error();
		}
		if($result){
	header("location:confirm.php?name=$name&regnumber=$reg");
		}
			}


}
?>


<center>        <a href="index.php" title="go home"><img src="images/home.gif" width="47" height="48" /></a></label></td>
</center>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<fieldset>
  <table class="formtable" width="90%" border="0" height="80">
    <tr>
      <td width="70"  align="right" valign="middle" >Name:</td>
      <td width="391" align="left" valign="middle"><label>
        <input type="text" name="name" id="name"  value="<?php  if ($_POST['name']){ echo $_POST['name'];}?>" size="60"/><span class="warning">***</span>
      </label></td>
    
      <td width="63"   align="right" valign="middle"> Address:</td>
      <td width="371" align="left" valign="middle"><label>
        <input name="add" type="text" id="add" value="<?php  if ($_POST['add']){ echo $_POST['add'];}?>" size="70" /><span class="warning">***</span>
      </label></td>
    </tr>
    <tr>
      <td   align="right" valign="middle">Phone No:</td>
      <td align="left" valign="middle"><label>
        <input type="text" name="pnum" id="pnum" value="<?php  if ($_POST['pnum']){ echo $_POST['pnum'];}?>" size="40"/><span class="warning">***</span>
      </label></td>
            <td   align="right" valign="middle">Age:</td>
      <td align="left" valign="middle"><?php 
				echo "<select name='age'>";
					echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
for($num=1; $num<=100; $num++){
		echo "<option value=$num>$num</option>";
	}
	echo "</select>";?>
    </td>

    </tr>
    <tr>
      <td   align="right" valign="middle">email</td>
      <td align="left" valign="middle"><input type="text" name="email" id="email" value="<?php  if ($_POST['pnum']){ echo $_POST['pnum'];}?>" size="40"/></td>
      <td   align="right" valign="middle">&nbsp;</td>
      <td align="left" valign="middle">&nbsp;</td>
    </tr>
    </table>
  </fieldset>
    <fieldset>
    <table border="0" width="90%" class="formtable" height="80"> 
    <tr>
      <td >Religion:</td>
      <td ><label>
        <select name="religion" id="religion">
          <option selected="selected" value="">Select</option>
          <option>.....................</option>
          
          <option value="Christian">Christian</option>
          <option value="Muslim">Muslim</option>
          <option value="Other">Other</option>
        </select>
      </label></td>
      <td  >Health Condition:</td>
      <td ><label>
        <input name="condition" type="text" id="condition" size="50" value="<?php  if ($_POST['condition']){ echo $_POST['condition'];}?>"/>
      </label></td>      
    </tr>
   
    <tr>
      <td>Previous Effort made till date:</td>
      <td ><label>
        <input name="previous" type="text" id="previous" size="50" value="<?php  if ($_POST['previous']){ echo $_POST['previous'];}?>"/>
      </label></td>
    <td>Present State of Health:</td>
    <td><input type="text" size="50" name="present" value="<?php  if ($_POST['present']){ echo $_POST['present'];}?>"/></td>
    
      
    </tr>
    </table>
    </fieldset>
    
    
    <fieldset>
    <table border="0" width="90%" class="formtable" height="100">
    <tr>
      <td >How did you know about Halleluyah diet:</td>
      <td ><label>
        <input name="how" type="text" id="how" size="50" value="<?php  if ($_POST['how']){ echo $_POST['how'];}?>"/>
      </label></td>
      
          <td>Remarks:</td>
    <td><input type="text" size="50" name="remark" value="<?php  if ($_POST['remark']){ echo $_POST['remark'];}?>"/></td>

    </tr>
  
    
    
    <tr>
      <td  a>Why do you seek Halleluyah diet?</td>
      <td ><label>
        <input name="why" type="text" id="why" size="50" value="<?php  if ($_POST['why']){ echo $_POST['why'];}?>"/>
      </label></td>
    
    <td>Date of registration:</td>
        <td>
        
    D <?php 
		echo "<select name='day'>";
		echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da){
echo "<option value=$da>$da</option>";
	}
?>
</select>
    M
		<?php echo "<select name='month'>";?>
        <?php $month=array('01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					echo "<option value=''>Select</option>";
		echo "<option value=''>-----------------</option>";
	foreach($month as $months){
		echo "<option value=$months>$months</option>";
	}
?></select>    
    
    Y:
    
    <?php  
			echo "<select name='year'>";

	echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
		for($my=2004; $my<=2015; $my++){
		echo "<option value=$my>$my</option>";
			}
?></select></label>
</td>
   
    
    </tr>
  
       
    <tr>
      <td align="right">&nbsp;</td>
      <td align="right"><input type="submit" name="submit"  value="Submit"  class="but" style="margin-top:30px;"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    

    
  </table>
</fieldset>
</form>
<center>        <a href="index.php" title="go home"><img src="images/home.gif" width="47" height="48" /></a></label></td>
</center>
</div></div>

<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>



</body>

</html>