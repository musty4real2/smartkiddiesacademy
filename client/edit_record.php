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
<body>
<div id="wrapper">
<div id="head">
<img src="../images/HEAD.jpg" width="1200" height="115" />
</div>


<div id="body">
<fieldset style="margin-top:50px;">

<legend><h1><img src="../images/pen.gif" width="92" height="80" />EDIT CLIENTS RECORD</h1></legend>

<?php

	include("../db_connect.php");

if($_POST['submit']){
	
	
	$name=addslashes($_POST['name']);
	
	
	
	$add=addslashes($_POST['add']);

	
	$pnum=addslashes($_POST['pnum']);
	$id=$_POST['cid'];
	$email=addslashes($_POST['email']);
	
	
	

	
	$condition=addslashes($_POST['condition']);
	
	
	$previous=addslashes($_POST['previous']);
	
	
		$rand=rand(1, 10000);
	$sub=substr($year, 2);
	$reg=$day."G".$month."I".$sub."L".$rand;

	
	
	$present=addslashes($_POST['present']);
	$how=addslashes($_POST['how']);
	
	$remark=addslashes($_POST['remark']);
	$why=addslashes($_POST['why']);
	
	$day=$_POST['day'];
	$month=$_POST['month'];
	$year=$_POST['year'];
	
	if($day!="" && $month!="" && $year!=""){
	$date="$day-$month-$year";
	
	$sql="UPDATE `gilgal`.`registration` SET `name` = '$name',
`address` = '$add',
`pnum` = '$pnum', `email`='$email',s
`condition` = '$condition',
`previous` = '$previous',
`how` = '$how',`why` = '$why',`date`='$date', `remark` = '$remark' , `present`='$present' WHERE `id`='$id'";	
	$result=mysql_query($sql);
	if($result){
	echo "<div class='enter'><center><p class='h1'>Client's record was updated sucessfully</p></center></div>";
		}
	
	elseif(!$result){
		die( "Could not compelete update. please try again".mysql_error());
		}
	
	
	}
	
	
if($day=="" && $month=="" && $year==""){	
	
	$sql="UPDATE `gilgal`.`registration` SET `name` = '$name',
`address` = '$add',
`pnum` = '$pnum',
`condition` = '$condition',
`previous` = '$previous',
`how` = '$how',`why` = '$why',`remark` = '$remark' , `present`='$present' WHERE `id`='$id'";	
	$result=mysql_query($sql);
	if($result){
	echo "<div class='enter'><center><p class='h1'>Client's record was updated sucessfully</p></center></div>";
		}
	
	elseif(!$result){
		die( "Could not compelete update. please try again".mysql_error());
		}
	
}
	
	}


	$id=$_GET['id'];
	$sql="SELECT * 
FROM `registration` 
WHERE `id`='$id'";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <table class="formtable" width="900" border="0" cellspacing="20">
    <tr>
      <td>Name</td>
      <td><label>
        <input type="text" name="name" size="80" value="<?php echo $row['name'];?>" />
      </label></td>
    </tr>
    <tr>
      <td>Residential Address</td>
      <td><label>
        <input name="add" type="text" value="<?php echo $row['address'];?>" size="80" />
      </label></td>
    </tr>
    <tr>
      <td>Phone Number</td>
      <td><label>
        <input type="text" name="pnum" value="<?php echo $row['pnum'];?>" />
      </label></td>
    </tr>
    <tr>
      <td>email</td>
      <td><label>
        <input type="text" name="email" value="<?php echo $row['email'];?>" />
      </label></td>
    </tr>
    <tr>
      <td>Health Condition</td>
      <td><label>
        <input name="condition" type="text" value="<?php echo $row['condition'];?>" size="50" />
      </label></td>
    </tr>
    <tr>
      <td>Previous Effort made till date</td>
      <td><label>
        <input name="previous" type="text" value="<?php echo $row['previous'];?>" size="50" />
      </label></td>
    </tr>
    <tr>
      <td>How did you know about Halleluyah diet</td>
      <td><label>
        <input name="how" type="text" value="<?php echo $row['how'];?>" size="40" />
      </label></td>
    </tr>
        <tr>
    <td>Remarks:</td>
    <td><input type="text" size="50" name="remark" value="<?php echo $row['remark'];?>" /></td>
    </tr>

       
    <tr>
      <td>Why do you seek Halleluyah diet?</td>
      <td><label>
        <input name="why" type="text" value="<?php echo $row['why'];?>" size="40" />
      </label></td>
    </tr>
         <input type="hidden" name="cid"  value="<?php echo $row['id'];?>"/>
    <tr>
    <td>Present State of Health:</td>
    <td><input type="text" size="50" name="present" value="<?php echo $row['present'];?>" /></td>
    </tr>
    
    <tr>
    <td>Date in database</td>
    <td><?php echo $row['date'];?></td>
    </tr>
    <tr>
        <td>Date of registration:</td>
        <td>
        
    DD <?php 
		echo "<select name='day'>";
		echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da){
echo "<option value=$da>$da</option>";
	}
?>
</select>
    MM
		<?php echo "<select name='month'>";?>
        <?php $month=array('01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					echo "<option value=''>Select</option>";
		echo "<option value=''>-----------------</option>";
	foreach($month as $months){
		echo "<option value=$months>$months</option>";
	}
?></select>    
    
    YYYY:
    
    <?php  
			echo "<select name='year'>";

	echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
		for($my=2004; $my<=2015; $my++){
		echo "<option value=$my>$my</option>";
			}
?></select></label>
<span class="warning">**Do not pick date if date in database is correct**</span></td>

    </tr>    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="submit"  style="margin-top:30px;"id="submit" value="EDIT"  class="but"/>
      </label></td>
      
    </tr>

  </table>
</form>
<?php } ?>
<center><a href="registration.php" title="register new client"><img src="images/add_voters.gif" width="47" height="47" /></a>		 <a href="index.php" title="go home"><img src="images/home.gif" width="47" height="48" /></a></center>
</div>
</div>


<img src="images/footer.gif" width="953" height="61" />

</div>

</body>
</html>