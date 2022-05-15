
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

<h1 class="h1"><img src="../images/icon_bagages.jpg" width="160" height="144" />Lodge form</h1>
<?php
if($_POST['submit']){
	include("../db_connect.php");
	$name=addslashes($_POST['name']);
	if(strlen($name)==0){
		$error[]="Client's Name is required<br/>";
		}
	
	
	

	$add=addslashes($_POST['add']);
	if(strlen($add)==0){
		$error[]="Client's Address is required<br/>";
		}
	
	
	$marry=$_POST['marry'];
	if(strlen($marry)==0){
		$error[]="Client's Marital status is required<br/>";
		}
	
	$spouse=$_POST['spouse'];
	
	$spouseno =$_POST['spouseno'];
	
	$garantor=$_POST['garantor'];
	$drugs=$_POST['drugs'];
	$chemo=$_POST['chemo'];
	$chemo_howmany=$_POST['chemo_howmany'];

	$radiation=$_POST['radiation'];
	$radiation_howmany=$_POST['radiation_howmany'];
	$surgery=$_POST['chemo'];
	$surgery_howmany=$_POST['surgery_howmany'];
	



$age=$_POST['age'];
	
	
	
	$religion=$_POST['religion'];
	if(strlen($religion)==0){
		$error[]="Client's Religion is required<br/>";
		}
	
	
	$condition=addslashes($_POST['condition']);

	$days=$_POST['day_spent'];
		if(strlen($days)==0){
		$error[]="Days spent is required<br/>";
		}

	$month=$_POST['month'];
	$day=$_POST['day'];
	$year=$_POST['year'];
	
	$date="$day-$month-$year"; 
	
	
	$sub=substr($year, 2);
	$reg="$day$month$sub";
	
	

		if(!empty($error)){
			echo "<center><h3 class='error'>Error!</h3><p>The following error occured:</p></center>";
			foreach($error as $msg){
				echo "<center><p class='er'>$msg</p></center>";
				}
				}
		if($name && $add && $religion){
			
			include ("db_connect.php");
			$sql="INSERT INTO `gilgal`.`lodge_guest` (
`name` ,
`address` ,
`age` ,
`religion` ,
`condition` ,
`marital` ,
`spouse` ,
`spouse no` ,
`garantor` ,
`day_spent` ,
`drugsb4` ,
`chemo` ,
`chemo_howmany` ,
`radiation` ,
`radiation_howmany` ,
`surgery` ,
`surgery_howmany` ,
`datereg`
)
VALUES (
'$name', '$add', '$age','$religion', '$condition', '$marry', '$spouse', '$spouseno', '$garantor', '$days', '$drugs', '$chemo', '$chemo_howmany', '$radiation', '$radiation_howmany', '$surgery', '$surgery_howmany', '$date')";



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


<center></label></td>
</center>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<fieldset>
  <table class="formtable" width="90%" border="0" height="80">
    <tr>
      <td  align="right" valign="middle" >Name:</td>
      <td width="480" align="left" valign="middle"><label>
        <input type="text" name="name" id="name"  value="<?php  if ($_POST['name']){ echo $_POST['name'];}?>" size="70"/><span class="warning">***</span>
      </label></td>
    
      <td   align="right" valign="middle"> Address:</td>
      <td align="left" valign="middle"><label>
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
      <td >Marital Status</td>
      <td ><label>
        <select name="marry" id="marry" >
          <option selected="selected" value="">Select</option>
          <option>.....................</option>
          
          <option value="Single">Single</option>
          <option value="Married">Married</option>
          <option value="Other">Other</option>
        </select>
      </label></td>
    <td></td>
    <td></td>
    </tr>
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
    </tr>
</table>
    </fieldset>
    
    
    
    
    
    
    
    
    
    
    <fieldset>
    <table border="0" width="90%" class="formtable" height="80"> 
    <tr>
     
      <td>Name of spouse (if any):</td>
      <td ><label>
        <input name="spouse" type="text" id="spouse" size="50" value="<?php  if ($_POST['spouse']){ echo $_POST['spouse'];}?>"/>
      </label></td>      
    </tr>
   
    <tr>
      <td>Spouse Phone no.</td>
      <td ><label>
        <input name="spouseno" type="text" id="spouseno" size="50" value="<?php  if ($_POST['spouseno']){ echo $_POST['spouseno'];}?>"/>
      </label></td>
    <td>Garantor's name:</td>
    <td><input name="garantor" type="text" id="garantor" value="<?php  if ($_POST['garantor']){ echo $_POST['garantor'];}?>" size="50"/></td>
    
      
    </tr>
    
    
    
    
    
    
    
    </table>
    </fieldset>
    
    
    
    
    
    
    
    <fieldset>
    <table border="0" width="90%" class="formtable" height="80"> 
    <tr>
     
      <td  >Health Condition:</td>
      <td ><label>
        <input name="condition" type="text" id="condition" size="50" value="<?php  if ($_POST['condition']){ echo $_POST['condition'];}?>"/>
      </label></td>      
    </tr>
   
    
    
    
    
    
    
    
    </table>
    </fieldset>
    
    
    <fieldset>
    <table border="0" width="90%" class="formtable" height="100">
    
    
    <tr>
    
    <td>Date Started:</td>
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
</td>
   <td>No of days Spent:</td>
        <td>
        
    DD <?php 
		echo "<select name='day_spent'>";
		echo "<option value=''>Select</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da){
echo "<option value=$da>$da</option>";
	}
?>
</td>
</tr>    

    
  </table>
</fieldset>


    <fieldset>
    <table border="0" width="90%" class="formtable" height="80"> 
   
    <tr>
     
      <td>Drugs or suppliment before comming?</td>
      <td><input name="drugs" type="text" id="drugs" size="60" value="<?php  if ($_POST['drugs']){ echo $_POST['drugs'];}?>" /></td> 
      
    </tr>
   
    <tr>
     
      <td>Chemotherapy:</td>
      <td><p>
        <label>
          <input type="radio" name="chemo" value="yes" id="RadioGroup1_0" />
          yes</label>
        <br />
        <label>
          <input type="radio" name="RadioGroup1" value="no" id="RadioGroup1_1" />
          no</label>
        <br />
      </p></td> 
      
      <td>How many?</td><td><input name="chemo_howmany" type="text" id="chemo_howmany" />     
    </tr>
   
   
       <tr>
     
      <td>Radiation:</td>
      <td><p>
        <label>
          <input type="radio" name="radiation" value="yes" id="RadioGroup1_0" />
          yes</label>
        <br />
        <label>
          <input type="radio" name="RadioGroup1" value="no" id="RadioGroup1_1" />
          no</label>
        <br />
      </p></td> 
      
      <td>How many?</td><td><input name="radiation_howmany" type="text" id="radiation_howmany" />     
    </tr>

    <tr>
     
      <td>Surgery:</td>
      <td><p>
        <label>
          <input type="radio" name="surgery" value="yes" id="RadioGroup1_0" />
          yes</label>
        <br />
        <label>
          <input type="radio" name="surgery" value="no" id="RadioGroup1_1" />
          no</label>
        <br />
      </p></td> 
      
      <td>How many?</td><td><input type="text" name="surgery_howmany"" />     
    </tr>

   
       </tr>
  
       
    <tr>
      <td align="right">&nbsp;</td>
      <td align="right"><input type="submit" name="submit"  value="Submit" /></td>
      <td align="left">&nbsp;</td>
    </tr>
    

    </table>
    </fieldset>




</form>
<center></label></td>
</center>
</div></div>

<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>



</body>

</html>