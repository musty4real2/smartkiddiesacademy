
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
FROM `lodge_guest` 
WHERE id='$id'";

	$result=mysql_query($sql);
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
            
            </tr>
       

    <tr>
 
       <td>Condition:</td>
 <td class="ans"><?php if($row['condition']==""){echo "-";} else echo $row['condition'];?></td>
    <td>Religion:</td>
    <td class="ans" width="93"><?php echo $row['religion'];?></td>
    </tr>
    <tr>
    <td>Day spent</td>
    <td class="ans"><?php if($row['day_spent']==""){echo "-";} else echo $row['day_spent'];?></td>
       <td>email:</td>
    <td class="ans"><?php if($row['day_spent']==""){echo "-";} else echo $row['day_spent'];?></td>
 </tr>
    <tr>
    <td>Date Started</td>
    <td class="ans"><?php if($row['datereg']==""){echo "-";} else echo $row['datereg'];?></td>
    <td>Chemotherapy</td>
    <td class="ans"><?php if($row['chemo']==""){echo "-";} else echo $row['chemo']. "({$row['chemo_howmany']})"; ?> </td>
    </tr>
    
    
        <tr>
    <td>Radiation:</td>
    <td class="ans"><?php if($row['radiation']==""){echo "-";} else echo $row['radiation']. "({$row['radiation_howmany']})";?></td>
    <td>Surgery:</td>
    <td class="ans"><?php if($row['surgery']==""){echo "-";} else echo $row['surgery']. "({$row['surgery_howmany']})"; ?> </td>
    </tr>

    
    <tr>
    <td>Spouse</td>
    <td class="ans"><?php if($row['spouse']==""){echo "-";} else echo $row['spouse'];?></td>
    <td>Spouse Phone no</td>
    <td class="ans"><?php if($row['spouse no']==""){echo "-";} else echo $row['spouse no'];?></td>
    </tr>
    
    
    <tr>
    <td>Garantor</td>
    <td class="ans"><?php if($row['garantor']==""){echo "-";} else echo $row['garantor'];?></td>
    
    </td>
    <tr>
    <td>Address:</td>
    <td class="ans"><?php if($row['address']==""){echo "-";} else echo $row['address'];?></td>
    </tr>
   
    
    
     
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 <?php }?>
     </table>
     
     
     
     
     
     
     

</fieldset>
</div>
</div>
<center><p>&copy;2012. All Rights Reserved. Gilgal Health Resource Centre</p></center>

</body>
</html>