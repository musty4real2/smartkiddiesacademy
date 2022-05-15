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

<center><h1 class="h4">Student Registration Form</h4></center>
<?php
if($_POST['submit']){
	
	$sname=addslashes($_POST['sname']);
	$fname=addslashes($_POST['fname']);
	$mname=addslashes($_POST['mname']);
	if(strlen($sname)==0){
		$error[]="Client's Surname is required<br/>";
		}
			if(strlen($fname)==0){
		$error[]="Client's Firstname is required<br/>";
		}

		$name="$sname $fname $mname";
		
				$dadname=addslashes($_POST['dadname']);
	if(strlen($dadname)==0){
		$error[]="Client's Dad name is required<br/>";
		}
		$dadresaddress=addslashes($_POST['dadresaddress']);
	if(strlen($dadresaddress)==0){
		$error[]="Client's Dad Residential Address is required<br/>";
		}
		
				$dadaddress=addslashes($_POST['dadaddress']);
	if(strlen($dadaddress)==0){
		$error[]="Client's Dad Office Address is required<br/>";
		}
				$dadphone=addslashes($_POST['dadphone']);
	if(strlen($dadphone)==0){
		$error[]="Client's Dad Phone is required<br/>";
		}
		
		
		
		
					$momname=addslashes($_POST['momname']);
	if(strlen($momname)==0){
		$error[]="Client's Mum name is required<br/>";
		}
		$momresaddress=addslashes($_POST['momresaddress']);
	if(strlen($momresaddress)==0){
		$error[]="Client's Mum Residential Address is required<br/>";
		}
		
				$momaddress=addslashes($_POST['momaddress']);
	if(strlen($momaddress)==0){
		$error[]="Client's Mum Office Address is required<br/>";
		}
				$momphone=addslashes($_POST['momphone']);
	if(strlen($dadphone)==0){
		$error[]="Client's Mum Phone is required<br/>";
		}
	
	
	$age=$_POST['age'];	
	
	$sex=addslashes($_POST['sex']);

	
	$stateoforigin=addslashes($_POST['stateoforigin']);
	
	$language=addslashes($_POST['language']);
	$nationality=addslashes($_POST['nationality']);
	$childhealth=addslashes($_POST['childhealth']);

	$lastattend=addslashes($_POST['lastattended']);	
	$lastclass=addslashes($_POST['lastclass']);	
	$reasonforleaving=addslashes($_POST['reasonforleaving']);
	$classtobeaddedto=addslashes($_POST['classtobeaddedto']);	
	$bplace=addslashes($_POST['bplace']);
	$bmonth=$_POST['bmonth'];
	$bday=$_POST['bday'];
	$byear=$_POST['byear'];
	
	$date="$bday-$bmonth-$byear"; 
	
		if(!empty($error)){
			echo "<center><h3 class='error'>Error!</h3><p>The following error occured:</p></center>";
			foreach($error as $msg){
				echo "<center><p class='er'>$msg</p></center>";
				}
				}
		if($name){
			
			$sql="INSERT INTO `smart`.`registration` (`child_name` ,`dob` ,`age` ,`sex` ,`place_of_birth` ,`state_of_origin` ,`languages_spoken` ,`last_school_attended` ,`last_class_passed` ,`reasons_for_leaving_last_school` ,
`class_you_wish_your_child_to_be_admitted_to` ,`dads_name` ,`dads_office_address` ,`dads_residential_address` ,`dads_phone` ,`mums_name` ,`mums_office_address` ,`mums_residential_address` ,`mums_phone` ,`nationality` ,`child_health_issues` ,`entry_date`
,`photo`,`treated`,`regno`,`date_of_admission`,`class_admitted_into`,`acknowledged_by`,`date_of_acknowledgement`,`house`)
VALUES ('$name', '$date', '$age', '$sex', '$bplace', '$stateoforigin', '$language', '$lastattend', '$lastclass', '$reasonforleaving', '$classtobeaddedto', '$dadname', '$dadaddress', '$dadresaddress', '$dadphone', '$momname', '$momaddress', '$momresaddress', '$momphone', '$nationality', '$childhealth',NOW(),'','1','','','','','','')";
	$result=mysql_query($sql);
	$id=mysql_insert_id($connection);
	if(!$result){
		echo "could not complete entry:".mysql_error();
		}
		if($result){
			$path = "../photo/";

	$valid_formats = array("jpg", "png", "gif", "bmp");
			$name1 = $_FILES['passport']['name'];
			$size1 = $_FILES['passport']['size'];
			
	
	
	
			if(strlen($name1))
				{
					list($txt, $ext) = explode(".", $name1);
					if(in_array($ext,$valid_formats))
					{
					if($size1<(1024*1024))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['passport']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
									
		$object->query("UPDATE  `registration` SET  `photo`='$actual_image_name' WHERE `id`='$id'");
								}
							else
								header("location:registration.php?id={$_GET['id']}&status=Failed to Upload Image");
						}
						else
						header("location:registration.php?id={$_GET['id']}&status=Image file size too large:  maximum size 1 MB");					
						}
						else
						header("location:registration.php?id={$_GET['id']}&status=Invalid file format. Please Upload a jpg, gif or png image");	
				}
				
			else{
				header("location:registration.php?id={$_GET['id']}&status=Please select image to upload!");
			}

	header("location:confirm.php?name=$name");
		}
			}


}
?>

    <form id="tab" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

<fieldset>
    <table class="formtable" width="90%" border="0" height="80"> 
    <tr>
    <td>Upload a Passport photograph of the child</td>
           <td><label>Passport:</label><input type="file" name="passport"/></td></tr>
    </tr>
    <tr>
      <td  valign="middle" >Surname:</td>
      <td valign="middle"><label>
        <input type="text" name="sname" id="name"  value="<?php  if ($_POST['sname']){ echo $_POST['sname'];}?>" size="60"/><span class="warning">***</span>
      </label></td></tr><tr>
            <td valign="middle" >First name:</td> 
      <td  valign="middle"><label>
        <input type="text" name="fname" id="name"  value="<?php  if ($_POST['fname']){ echo $_POST['fname'];}?>" size="60"/><span class="warning">***</span>
      </label></td>
     
      </tr>
      <tr>
            <td valign="middle" >Middle name:</td>
      <td  valign="middle"><label>
        <input type="text" name="mname" id="name"  value="<?php  if ($_POST['mname']){ echo $_POST['mname'];}?>" size="60"/><span class="warning">***</span>
      </label></td></tr><tr>
      <td  valign="middle"> Address:</td>
      <td  valign="middle"><label>
        <textarea name="address" rols="5" cols="38"></textarea>
        <span class="warning">***</span>
      </label></td>
    </tr>
     <tr>
      <td valign="middle">Date of Birth</td>
      <td valign="middle"><?php 
		echo "<select name='bday'>";
		echo "<option value=''>day</option>";
		echo "<option value=''>---</option>";
$days=range(1, 31);
foreach($days as $da){
echo "<option value=$da>$da</option>";
	}
?>
</select>
    
		<?php echo "<select name='bmonth'>";?>
        <?php $month=array('01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					echo "<option value=''>month</option>";
		echo "<option value=''>-----------------</option>";
	foreach($month as $months){
		echo "<option value=$months>$months</option>";
	}
?></select>    
    
    <?php  
			echo "<select name='byear'>";

	echo "<option value=''>year</option>";
		echo "<option value=''>---</option>";
		for($my=2004; $my<=2015; $my++){
		echo "<option value=$my>$my</option>";
			}
?></select>
</td>
    </tr>
    
     <tr><td>&nbsp;</td></tr>
  <tr>
            <td valign="middle">Age:</td>
      <td><?php 
				echo "<select name='age'>";
					echo "<option value=''>select</option>";
		echo "<option value=''>---</option>";
for($num=1; $num<=100; $num++){
		echo "<option value=$num>$num</option>";
	}
	echo "</select>";?>
    </td>

    </tr>
    <tr>
      <td  valign="middle"> Sex:</td>
      <td  valign="middle">
        Male: <input type="radio" name="sex" value="male" /> Female: <input type="radio" name="sex" value="female"/>
  </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td width="39%" >Place of Birth :</td>
      <td width="59%" ><label>
        <input name="bplace" type="text" id="bplace" size="50" value="<?php  if ($_POST['bplace']){ echo $_POST['bplace'];}?>"/>
      </label></td></tr>
   <tr>
      <td width="39%" >State of Origin:</td>
      <td width="59%" ><label>
  <select class="smallInput" name="stateoforigin">
        <option value="">select</option>
        <option value="">..................</option>
        <?php
      $states=array('Abia', 'Adamawa','Akwa-Ibom', 'Anambra',
					' Bauchi',' Bayelsa', 'Benue','Borno', 'Cross River', 
					'Delta', 'Ebonyi', 'Edo','Ekiti','Enugu',  'Gombe', 
					'Imo','Jigawa','Kaduna', 'Kano', 'Katsina','Kebbi','Kogi','Kwara',
					'Lagos','Nasarawa','Niger','Ogun','Ondo','Osun','Oyo', 'Plateau','Rivers',
					'Sokoto','Taraba','Yobe','Zamfara', 'Abuja');
	  foreach($states as $key => $stat){
		  echo "<option value='$stat'>$stat</option>";
		  }
  

	
      
      ?>
        <?php if($_POST['stateoforigin']){echo "<option  value='{$_POST['stateoforigin']}' selected='selected'>{$_POST['stateoforigin']}</option>"; }?>
        </select>
      </label></td></tr>
      
      
      <tr>
      <td width="39%" >Languages spoken by the child:</td>
      <td width="59%" ><label>
<textarea name="language" rols="5" cols="38"></textarea>      </label></td></tr>
 <tr>
      <td width="39%" >Last School Attended:</td>
      <td width="59%" ><label>
<textarea name="lastattended" rols="5" cols="38"></textarea>      </label></td></tr>
 <tr>
      <td width="39%" >Last Class Passed:</td>
      <td width="59%" ><label>
        <input name="lastclass" type="text" id="how" size="50" value="<?php  if ($_POST['lastclass']){ echo $_POST['lastclass'];}?>"/></label></td></tr>
         <tr>
      <td width="39%">Reasons for Leaving Previous School:</td>
      <td width="59%"><label>
<textarea name="reasonforleaving" rols="5" cols="38"></textarea> </label></td></tr>
    <tr>
      <td width="39%" >Class you wish your child to be admitted to:</td>
      <td width="59%" ><label>
        <input name="classtobeaddedto" type="text" id="how" size="50" value="<?php  if ($_POST['classtobeaddedto']){ echo $_POST['classtobeaddedto'];}?>"/>
      </label></td></tr>
    </table>
  </fieldset>
<center><h2>PARENT/GUARDIAN DETAIL</h2></center>
    <fieldset>
    <table border="0" width="90%" class="formtable" height="100">
    <tr>
      <td width="39%" >Dad's Name</td>
      <td width="59%" ><label>
        <input name="dadname" type="text" id="dadname" size="50" value="<?php  if ($_POST['dadname']){ echo $_POST['dadame'];}?>"/>
      </label></td></tr><tr>
      
          <td>Dad's Office Address:</td>
    <td><textarea name="dadaddress" ></textarea></td>

    </tr>
  
    
    
    <tr>
      <td>Dad's Residential Address</td>
      <td><label>
        <input name="dadresaddress" type="text" id="dadresaddress" size="50" value="<?php  if ($_POST['dadresaddress']){ echo $_POST['dadresaddress'];}?>"/>
      </label></td>
    </tr><tr>
    <td>Dad's Phone Number:</td>
        <td>
           <input name="dadphone" type="text" id="dadphone" size="50" value="<?php  if ($_POST['dadphone']){ echo $_POST['dadphone'];}?>"/>
    
</td>
   
    
    </tr>



<!--mom details-->
<tr>
      <td width="39%" >Mum's Name</td>
      <td width="59%" ><label>
        <input name="momname" type="text" id="momname" size="50" value="<?php  if ($_POST['momname']){ echo $_POST['momame'];}?>"/>
      </label></td></tr><tr>
      
          <td>Mum's Office Address:</td>
    <td><textarea name="momaddress" ></textarea></td>

    </tr>
  
    
    
    <tr>
      <td>Mum's Residential Address</td>
      <td><label>
        <input name="momresaddress" type="text" id="momresaddress" size="50" value="<?php  if ($_POST['momresaddress']){ echo $_POST['dadresaddress'];}?>"/>
      </label></td>
    </tr><tr>
    <td>Mum's Phone Number:</td>
        <td>
           <input name="momphone" type="text" id="momphone" size="50" value="<?php  if ($_POST['momphone']){ echo $_POST['momphone'];}?>"/>
    
</td>
   
    
    </tr>
    <tr>
    <td>Nationality:</td>
        <td>
           <input name="nationality" type="text" id="nationality" size="50" value="<?php  if ($_POST['nationality']){ echo $_POST['nationality'];}?>"/>
    
</td>
   
    
    </tr>
    <tr>
    <td>State any Special health Problem of the child:</td>
        <td>
           <textarea name="childhealth"></textarea>
    
</td>
   
    
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
<center>        <a href="menu.php" title="go home"><img src="../images/home.gif" width="47" height="48" /></a></label></td>
</center>
</div></div>

<center><p>&copy;<?php echo date('Y'); ?>. All Rights Reserved.</p></center>



</body>

</html>