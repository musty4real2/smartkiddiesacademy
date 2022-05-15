
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

<legend><h1><img src="images/zoom.gif" width="125" height="129" />Client's Record</h1></legend>

<?php
	
	$id=$_GET['id'];
	include("../db_connect.php");
	$sql="SELECT * 
FROM `registration` 
WHERE id='$id'";

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

		    
          
           
           <table class="recordtab" border="0"><?php 
	while ($row=mysql_fetch_array($result)){
  ?>
            <tr>
            <td width="251"><p>Name:</td>
            <td width="290"> <span class="h1">Mr/Mrs<?php echo "   ".$row['name'];?></span></p></td>
            <td width="108">Registration Number:</td>
            <td class="h1"><?php echo $row['reg_no'];?></td>
            
            </tr>
       

    <tr>
 
       <td>Condition:</td>
 <td class="ans"><?php if($row['condition']==""){echo "-";} else echo $row['condition'];?></td>
    <td>Religion:</td>
    <td class="ans" width="93"><?php echo $row['religion'];?></td>
    </tr>
    <tr>
    <td>Phone Number:</td>
    <td class="ans"><?php if($row['pnum']==""){echo "-";} else echo $row['pnum'];?></td>
       <td>email:</td>
    <td class="ans"><?php if($row['email']==""){echo "-";} else echo $row['email'];?></td>
 </tr>
    <tr>
    <td>Why do you seek Halleluyah diet:</td>
    <td class="ans"><?php if($row['why']==""){echo "-";} else echo $row['why'];?></td>
    <td>Age:</td>
    <td class="ans"><?php if($row['age']==""){echo "-";} else echo $row['age'];?></td>
    </tr>
    <tr>
    <td>How did you know about Halleluyah diet:</td>
    <td class="ans"><?php if($row['how']==""){echo "-";} else echo $row['how'];?></td>
    <td>Previous Effort made:</td>
    <td class="ans"><?php if($row['previous']==""){echo "-";} else echo $row['previous'];?></td>
    </tr>
    
    
    <tr>
    <td>Remark:</td>
    <td class="ans"><?php if($row['remark']==""){echo "-";} else echo $row['remark'];?></td>
    
    </td>
    <tr>
    <td>Address:</td>
    <td class="ans"><?php if($row['address']==""){echo "-";} else echo $row['address'];?></td>
    <td>Date of Registration:</td>
    <td class="ans"><?php if($row['date']==""){echo "-";} else  echo $row['date'];?></td>
    </tr>
   
    
    
     
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 <?php }?>
     </table>
     
     
     
     
     
     
     

<center><a href="registration.php" title="register new client"><img src="images/add_voters.gif" width="47" height="47" /></a>		 <a href="index.php" title="go home"><img src="images/home.gif" width="47" height="48" /></a></center>

</div>
</div>
<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>

</body>
</html>